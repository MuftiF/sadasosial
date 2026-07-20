<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Perizinan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PerizinanWorkflowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest cannot access perizinan index.
     */
    public function test_guest_cannot_access_perizinan(): void
    {
        $response = $this->get('/perizinan');
        $response->assertRedirect('/login');
    }

    /**
     * User can submit a new UGB perizinan application.
     */
    public function test_user_can_submit_ugb_application(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->post('/perizinan/buat/ugb', [
            'action' => 'submit',
            'nama_penyelenggara' => 'Yayasan Test Mandiri',
            'nama_undian' => 'Undian Berkah Gemilang 2026',
            'total_hadiah' => '80000000',
            'waktu_pelaksanaan' => '17 Agustus 2026',
            'deskripsi_kegiatan' => 'Promosi undian berhadiah dengan cara mengumpulkan stiker belanja.',
            'konfirmasi_wilayah' => '1',
        ]);

        $response->assertRedirect('/perizinan');
        $this->assertDatabaseHas('perizinans', [
            'pemohon_id' => $user->id,
            'jenis_layanan' => 'ugb',
            'status' => 'diperiksa',
            'tahap_verifikasi' => 'sekretariat',
            'konfirmasi_wilayah' => true,
        ]);
    }

    /**
     * Multi-stage verification workflow test.
     */
    public function test_multi_stage_verification_workflow(): void
    {
        $pemohon = User::factory()->create(['role' => 'user', 'validation_status' => 'validated']);
        
        // Create an application waiting at sekretariat stage
        $perizinan = Perizinan::create([
            'pemohon_id' => $pemohon->id,
            'jenis_layanan' => 'ugb',
            'status' => 'diperiksa',
            'tahap_verifikasi' => 'sekretariat',
            'konfirmasi_wilayah' => true,
            'data_tambahan' => [
                'nama_penyelenggara' => 'Yayasan Test',
                'nama_undian' => 'Gebyar Undian 2026',
                'total_hadiah' => '100000000',
                'waktu_pelaksanaan' => '30 September 2026',
            ],
            'history_status' => [],
        ]);

        // 1. Sekretariat marks as Lengkap -> moves to Verifikator
        $sekretariat = User::factory()->create(['role' => 'sekretariat']);
        $response = $this->actingAs($sekretariat)->post("/admin/perizinan/{$perizinan->id}/proses", [
            'action' => 'approve',
            'catatan' => 'Berkas lengkap sesuai persyaratan awal.',
        ]);
        $response->assertRedirect('/perizinan');
        $this->assertDatabaseHas('perizinans', [
            'id' => $perizinan->id,
            'tahap_verifikasi' => 'verifikator',
            'status' => 'diperiksa',
        ]);

        // 2. Verifikator marks as Valid -> moves to Dinsos Wilayah
        $verifikator = User::factory()->create(['role' => 'verifikator']);
        $response = $this->actingAs($verifikator)->post("/admin/perizinan/{$perizinan->id}/proses", [
            'action' => 'approve',
            'catatan' => 'Legalitas valid dan terakreditasi.',
        ]);
        $this->assertDatabaseHas('perizinans', [
            'id' => $perizinan->id,
            'tahap_verifikasi' => 'dinsos_wilayah',
        ]);

        // 3. Dinsos Wilayah marks as Layak -> moves to Bidang Teknis
        $dinsosWilayah = User::factory()->create(['role' => 'dinsos_wilayah']);
        $response = $this->actingAs($dinsosWilayah)->post("/admin/perizinan/{$perizinan->id}/proses", [
            'action' => 'approve',
            'catatan' => 'Hasil survei lokasi layak dilaksanakan.',
        ]);
        $this->assertDatabaseHas('perizinans', [
            'id' => $perizinan->id,
            'tahap_verifikasi' => 'bidang_teknis',
        ]);

        // 4. Bidang Pemberdayaan drafts recommendation -> moves to Kepala Dinas
        $bidang = User::factory()->create(['role' => 'bidang_pemberdayaan']);
        $response = $this->actingAs($bidang)->post("/admin/perizinan/{$perizinan->id}/proses", [
            'action' => 'approve',
            'nomor_surat_rekomendasi' => 'REK/UGB/2026/012',
            'catatan' => 'Substansi memenuhi standar, rekomendasi diteruskan.',
        ]);
        $this->assertDatabaseHas('perizinans', [
            'id' => $perizinan->id,
            'tahap_verifikasi' => 'kepala_dinas',
        ]);

        // 5. Kepala Dinas approves -> status Selesai
        $kadinas = User::factory()->create(['role' => 'kadinas']);
        $response = $this->actingAs($kadinas)->post("/admin/perizinan/{$perizinan->id}/proses", [
            'action' => 'approve',
            'catatan' => 'Disetujui dan ditandatangani secara elektronik (TTE).',
        ]);
        
        $perizinan->refresh();
        $this->assertEquals('selesai', $perizinan->status);
        $this->assertNotNull($perizinan->nomor_izin);
        $this->assertNotNull($perizinan->qr_code_token);

        // 6. Public can verify the QR code token
        $publicResponse = $this->get("/verifikasi-dokumen/{$perizinan->qr_code_token}");
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee($perizinan->nomor_izin);
    }

    /**
     * Test UGB execution report submission and approval flow.
     */
    public function test_ugb_reporting_flow(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');

        $pemohon = User::factory()->create(['name' => 'PT. Test Undian', 'role' => 'user', 'validation_status' => 'validated']);
        
        // Create an approved UGB perizinan
        $perizinan = Perizinan::create([
            'pemohon_id' => $pemohon->id,
            'jenis_layanan' => 'ugb',
            'status' => 'selesai',
            'tahap_verifikasi' => 'selesai',
            'nomor_izin' => '503/UGB/2026/0001',
            'tanggal_terbit' => now(),
            'tanggal_kadaluarsa' => now()->addMonths(3),
            'qr_code_token' => 'ugbtesttoken123',
            'data_tambahan' => [
                'nama_penyelenggara' => 'PT. Test Undian',
                'nama_undian' => 'Undian Berhadiah',
            ],
            'history_status' => [],
        ]);

        // 1. Pemohon views the UGB report submission form
        $response = $this->actingAs($pemohon)->get("/perizinan/{$perizinan->id}/laporan");
        $response->assertStatus(200);
        $response->assertSee('Laporan Pelaksanaan UGB');

        // 2. Pemohon submits the report with required documents
        $response = $this->actingAs($pemohon)->post("/perizinan/{$perizinan->id}/laporan", [
            'dokumen_laporan' => \Illuminate\Http\UploadedFile::fake()->create('laporan.pdf', 100),
            'daftar_pemenang' => \Illuminate\Http\UploadedFile::fake()->create('pemenang.xlsx', 100),
            'dokumentasi_kegiatan' => \Illuminate\Http\UploadedFile::fake()->create('dokumentasi.zip', 500),
            'catatan_pelaksanaan' => 'Draw completed with saksi, notary, and local police present.',
        ]);

        $response->assertRedirect("/perizinan/{$perizinan->id}");
        $this->assertDatabaseHas('perizinans', [
            'id' => $perizinan->id,
            'laporan_status' => 'diperiksa',
        ]);

        // 3. Bidang Pemberdayaan Sosial checks the dashboard queue
        $bidang = User::factory()->create(['role' => 'bidang_pemberdayaan']);
        $response = $this->actingAs($bidang)->get("/admin/pemberdayaan");
        $response->assertStatus(200);
        $response->assertSee('Antrean Laporan Pelaksanaan UGB');
        $response->assertSee('PT. Test Undian');

        // 4. Bidang Pemberdayaan Sosial approves the report
        $response = $this->actingAs($bidang)->post("/admin/perizinan/{$perizinan->id}/laporan/proses", [
            'action' => 'approve',
            'catatan' => 'Laporan lengkap dan valid sesuai Berita Acara.',
        ]);

        $response->assertRedirect("/perizinan/{$perizinan->id}");
        
        $perizinan->refresh();
        $this->assertEquals('disetujui', $perizinan->laporan_status);
        $this->assertEquals('Laporan lengkap dan valid sesuai Berita Acara.', $perizinan->laporan_catatan);
    }

    /**
     * Authenticated user can view the UGB SOP page.
     */
    public function test_user_can_view_ugb_sop(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/perizinan/sop/ugb');
        $response->assertStatus(200);
        $response->assertSee('SOP Penyelenggaraan UGB');
        $response->assertSee('SOP Pelaksanaan Pengundian');
        $response->assertSee('SOP Patroli Pengawasan');
    }
}
