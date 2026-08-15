<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RehabilitasiSosial;

class RehabilitasiSosialTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $verifikator;
    protected $analis;
    protected $kasi;
    protected $uptd;
    protected $kabid;

    protected function setUp(): void
    {
        parent::setUp();

        // Setup Users
        $this->user = User::factory()->create(['role' => 'user', 'account_type' => 'masyarakat']);
        $this->verifikator = User::factory()->create(['role' => 'verifikator']);
        $this->analis = User::factory()->create(['role' => 'analis_rehabilitasi']);
        $this->kasi = User::factory()->create(['role' => 'kasi_rehabilitasi']);
        $this->uptd = User::factory()->create(['role' => 'uptd_mitra']);
        $this->kabid = User::factory()->create(['role' => 'kabid_rehabilitasi']);
    }

    /**
     * Test user can access main portal index
     */
    public function test_user_can_view_rehabilitasi_portal()
    {
        $response = $this->actingAs($this->user)->get(route('rehabilitasi.index'));
        $response->assertStatus(200);
        $response->assertSee('Portal Rehabilitasi Sosial');
    }

    /**
     * Test user can view Penambahan Gizi Anak Panti SOP page
     */
    public function test_user_can_view_gizi_anak_sop()
    {
        $response = $this->actingAs($this->user)->get(route('rehabilitasi.sop.gizi_anak'));
        $response->assertStatus(200);
        $response->assertSee('SOP Penyaluran Bansos Penambahan Gizi Anak');
    }

    /**
     * Test user can view categories cases list
     */
    public function test_user_can_view_category_cases_list()
    {
        $case = RehabilitasiSosial::create([
            'user_id' => $this->user->id,
            'kategori' => 'anak',
            'nama_klien' => 'Klien Anak Test',
            'nik' => '1234567890123456',
            'kab_kota' => 'Kota Medan',
            'alamat' => 'Alamat Test',
            'deskripsi_kasus' => 'Klien terlantar butuh gizi.',
            'status_workflow' => 'diajukan',
        ]);

        $response = $this->actingAs($this->user)->get(route('rehabilitasi.subproses.index', 'anak'));
        $response->assertStatus(200);
        $response->assertSee('Klien Anak Test');
    }

    /**
     * Test user can submit a new rehabilitasi case
     */
    public function test_user_can_submit_new_case()
    {
        $data = [
            'nama_klien' => 'Klien Lansia Baru',
            'nik' => '9876543210123456',
            'kab_kota' => 'Kota Binjai',
            'alamat' => 'Alamat Lansia Binjai',
            'deskripsi_kasus' => 'Lansia terlantar butuh bantuan.',
        ];

        $response = $this->actingAs($this->user)->post(route('rehabilitasi.store', 'lansia'), $data);
        $response->assertRedirect(route('rehabilitasi.subproses.index', 'lansia'));
        $this->assertDatabaseHas('rehabilitasi_sosials', [
            'nama_klien' => 'Klien Lansia Baru',
            'kategori' => 'lansia',
            'status_workflow' => 'diajukan',
        ]);
    }

    /**
     * Test step 2: Verifikasi Administrasi oleh Verifikator
     */
    public function test_verifikator_can_approve_administrasi()
    {
        $case = RehabilitasiSosial::create([
            'user_id' => $this->user->id,
            'kategori' => 'anak',
            'nama_klien' => 'Klien Anak Test',
            'nik' => '1234567890123456',
            'kab_kota' => 'Kota Medan',
            'alamat' => 'Alamat Test',
            'deskripsi_kasus' => 'Klien terlantar butuh gizi.',
            'status_workflow' => 'diajukan',
        ]);

        $response = $this->actingAs($this->verifikator)->post(route('rehabilitasi.verifikasi_admin', $case->id), [
            'status' => 'setuju',
            'catatan' => 'Berkas lengkap dan sesuai.',
        ]);

        $response->assertRedirect();
        $case->refresh();
        $this->assertEquals('verifikasi_awal', $case->status_workflow);
        $this->assertNotNull($case->verifikasi_admin);
        $this->assertEquals('setuju', $case->verifikasi_admin['status']);
    }

    /**
     * Test step 4: Asesmen Kebutuhan Klien oleh Analis
     */
    public function test_analis_can_submit_asesmen()
    {
        $case = RehabilitasiSosial::create([
            'user_id' => $this->user->id,
            'kategori' => 'disabilitas',
            'nama_klien' => 'Klien Disabilitas',
            'nik' => '1234567890123456',
            'kab_kota' => 'Kota Medan',
            'alamat' => 'Alamat Test',
            'deskripsi_kasus' => 'Disabilitas butuh kruk.',
            'status_workflow' => 'proses_asesmen',
        ]);

        $response = $this->actingAs($this->analis)->post(route('rehabilitasi.asesmen', $case->id), [
            'analisis' => 'Klien memerlukan kruk fisik.',
            'alat_bantu' => 'Kruk Fisik Kanan',
        ]);

        $response->assertRedirect();
        $case->refresh();
        $this->assertEquals('proses_rekomendasi', $case->status_workflow);
        $this->assertNotNull($case->asesmen_kebutuhan);
        $this->assertEquals('Kruk Fisik Kanan', $case->asesmen_kebutuhan['alat_bantu']);
    }

    /**
     * Test step 5: Rekomendasi & Rujukan oleh Kasi
     */
    public function test_kasi_can_submit_rujukan()
    {
        $case = RehabilitasiSosial::create([
            'user_id' => $this->user->id,
            'kategori' => 'lansia',
            'nama_klien' => 'Klien Lansia',
            'nik' => '1234567890123456',
            'kab_kota' => 'Kota Medan',
            'alamat' => 'Alamat Test',
            'deskripsi_kasus' => 'Lansia terlantar.',
            'status_workflow' => 'proses_rekomendasi',
        ]);

        $response = $this->actingAs($this->kasi)->post(route('rehabilitasi.rekomendasi', $case->id), [
            'rekomendasi' => 'Rujuk ke UPTD Lansia.',
            'perlu_rujukan' => '1',
            'nama_uptd_lembaga' => 'UPTD Rehabilitasi Sosial Lansia',
        ]);

        $response->assertRedirect();
        $case->refresh();
        $this->assertEquals('dirujuk', $case->status_workflow);
        $this->assertTrue($case->perlu_rujukan);
        $this->assertEquals('UPTD Rehabilitasi Sosial Lansia', $case->nama_uptd_lembaga);
    }

    /**
     * Test step 6: Tanggapan Rujukan oleh UPTD
     */
    public function test_uptd_can_accept_rujukan()
    {
        $case = RehabilitasiSosial::create([
            'user_id' => $this->user->id,
            'kategori' => 'lansia',
            'nama_klien' => 'Klien Lansia',
            'nik' => '1234567890123456',
            'kab_kota' => 'Kota Medan',
            'alamat' => 'Alamat Test',
            'deskripsi_kasus' => 'Lansia terlantar.',
            'perlu_rujukan' => true,
            'nama_uptd_lembaga' => 'UPTD Rehabilitasi Sosial Lansia',
            'status_workflow' => 'dirujuk',
        ]);

        $response = $this->actingAs($this->uptd)->post(route('rehabilitasi.tanggapan_rujukan', $case->id), [
            'status_penerimaan_uptd' => 'diterima',
            'catatan_uptd' => 'Kamar tersedia.',
        ]);

        $response->assertRedirect();
        $case->refresh();
        $this->assertEquals('diterima_mitra', $case->status_workflow);
        $this->assertEquals('diterima', $case->status_penerimaan_uptd);
    }

    /**
     * Test step 7: Selesai oleh Kabid
     */
    public function test_kabid_can_close_case()
    {
        $case = RehabilitasiSosial::create([
            'user_id' => $this->user->id,
            'kategori' => 'lansia',
            'nama_klien' => 'Klien Lansia',
            'nik' => '1234567890123456',
            'kab_kota' => 'Kota Medan',
            'alamat' => 'Alamat Test',
            'deskripsi_kasus' => 'Lansia terlantar.',
            'perlu_rujukan' => true,
            'nama_uptd_lembaga' => 'UPTD Rehabilitasi Sosial Lansia',
            'status_penerimaan_uptd' => 'diterima',
            'status_workflow' => 'diterima_mitra',
        ]);

        $response = $this->actingAs($this->kabid)->post(route('rehabilitasi.selesai', $case->id));

        $response->assertRedirect();
        $case->refresh();
        $this->assertEquals('selesai', $case->status_workflow);
    }
}
