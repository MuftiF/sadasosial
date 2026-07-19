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
}
