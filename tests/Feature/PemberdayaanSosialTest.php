<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\PembinaanKelembagaan;
use App\Models\PembinaanPilar;
use App\Models\FasilitasiKomunitas;
use App\Models\KegiatanKesetiakawanan;
use App\Models\PengelolaanKepahlawanan;
use App\Models\MonevPemberdayaan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PemberdayaanSosialTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_pemberdayaan_portal(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->get('/pemberdayaan');
        $response->assertStatus(200);
        $response->assertSee('Proses Bisnis 2: Pemberdayaan Sosial');
    }

    public function test_user_can_submit_pembinaan_kelembagaan(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->post('/pemberdayaan/kelembagaan/buat', [
            'nama_lembaga' => 'LKS Sejahtera Bersama',
            'jenis_lembaga' => 'Lembaga Kesejahteraan Sosial (LKS)',
            'nomor_registrasi' => 'LKS-12345',
            'kab_kota' => 'Kota Medan',
            'alamat_lembaga' => 'Jl. Merdeka No. 45 Medan',
            'usulan_pembinaan' => 'Pembinaan akreditasi dan tata kelola organisasi',
        ]);

        $response->assertRedirect('/pemberdayaan/kelembagaan');
        $this->assertDatabaseHas('pembinaan_kelembagaans', [
            'nama_lembaga' => 'LKS Sejahtera Bersama',
            'status_workflow' => 'diajukan',
        ]);
    }

    public function test_user_can_submit_pembinaan_pilar(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->post('/pemberdayaan/pilar/buat', [
            'kategori_pilar' => 'tksk',
            'nama_pilar' => 'TKSK Kecamatan Medan Baru',
            'kab_kota' => 'Kota Medan',
            'usulan_pembinaan' => 'Bimtek pendataaan PMKS terpadu',
        ]);

        $response->assertRedirect('/pemberdayaan/pilar');
        $this->assertDatabaseHas('pembinaan_pilars', [
            'nama_pilar' => 'TKSK Kecamatan Medan Baru',
            'status_workflow' => 'diajukan',
        ]);
    }

    public function test_user_can_submit_fasilitasi_komunitas(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->post('/pemberdayaan/komunitas/buat', [
            'nama_komunitas' => 'Kelompok Disabilitas Bina Mandiri',
            'jenis_kelompok' => 'disabilitas',
            'kab_kota' => 'Kab. Deli Serdang',
            'alamat' => 'Desa Bandar Klippa',
            'usulan_kebutuhan' => 'Bantuan kewirausahaan dan alat bantu',
        ]);

        $response->assertRedirect('/pemberdayaan/komunitas');
        $this->assertDatabaseHas('fasilitasi_komunitases', [
            'nama_komunitas' => 'Kelompok Disabilitas Bina Mandiri',
            'status_workflow' => 'diajukan',
        ]);
    }

    public function test_user_can_view_sop_bk3s(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->get('/pemberdayaan/kelembagaan/sop-bk3s');
        $response->assertStatus(200);
        $response->assertSee('SOP Bantuan Badan Koordinasi Kegiatan Kesejahteraan Sosial');
    }

    public function test_user_can_view_sop_stp(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->get('/pemberdayaan/kelembagaan/sop-stp');
        $response->assertStatus(200);
        $response->assertSee('SOP Penerbitan Surat Tanda Pendaftaran');
    }
}