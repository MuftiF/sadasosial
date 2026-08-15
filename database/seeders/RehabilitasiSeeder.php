<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RehabilitasiSosial;

class RehabilitasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Staff User Baru jika belum ada
        $staffUsers = [
            [
                'name' => 'Analis Rehab Sosial',
                'email' => 'analis_rehab@sadasosial.org',
                'password' => bcrypt('password'),
                'role' => 'analis_rehabilitasi',
            ],
            [
                'name' => 'Kasi Rehab Sosial',
                'email' => 'kasi_rehab@sadasosial.org',
                'password' => bcrypt('password'),
                'role' => 'kasi_rehabilitasi',
            ],
            [
                'name' => 'Kabid Rehab Sosial',
                'email' => 'kabid_rehab@sadasosial.org',
                'password' => bcrypt('password'),
                'role' => 'kabid_rehabilitasi',
            ],
            [
                'name' => 'Lembaga UPTD Mitra',
                'email' => 'uptd_mitra@sadasosial.org',
                'password' => bcrypt('password'),
                'role' => 'uptd_mitra',
            ],
            // Pastikan verifikator & wilayah umum juga ada
            [
                'name' => 'Petugas Verifikator',
                'email' => 'verifikator@sadasosial.org',
                'password' => bcrypt('password'),
                'role' => 'verifikator',
            ],
            [
                'name' => 'Petugas Wilayah Dinsos',
                'email' => 'wilayah@sadasosial.org',
                'password' => bcrypt('password'),
                'role' => 'dinsos_wilayah',
            ]
        ];

        foreach ($staffUsers as $uData) {
            User::firstOrCreate(['email' => $uData['email']], $uData);
        }

        // Cari pemohon biasa (Siti Aminah, ID 2)
        $pemohon = User::where('role', 'user')->first() ?? User::first();

        // 2. Buat Dummy Kasus di berbagai status workflow

        // Kasus 1: Anak Yatim Piatu (Diajukan)
        RehabilitasiSosial::create([
            'user_id' => $pemohon->id,
            'kategori' => 'anak',
            'nama_klien' => 'Rian Ramadhan',
            'nik' => '1271021208150001',
            'kab_kota' => 'Kota Medan',
            'alamat' => 'Jl. Sisingamangaraja No. 45, Medan',
            'deskripsi_kasus' => 'Anak terlantar yatim piatu berumur 11 tahun ditemukan hidup di jalanan tanpa wali. Membutuhkan penempatan panti asuhan serta jaminan akses sekolah.',
            'status_workflow' => 'diajukan',
        ]);

        // Kasus 2: Lansia Sebatang Kara (Proses Asesmen)
        RehabilitasiSosial::create([
            'user_id' => $pemohon->id,
            'kategori' => 'lansia',
            'nama_klien' => 'Nenek Sumiati',
            'nik' => '1202055410420003',
            'kab_kota' => 'Kabupaten Deli Serdang',
            'alamat' => 'Desa Tanjung Morawa B, Dusun III',
            'deskripsi_kasus' => 'Lanjut usia berumur 83 tahun tinggal sebatang kara di gubuk reot. Sakit-sakitan dan tidak memiliki kerabat dekat. Memerlukan bantuan sembako LKS LU dan perawatan panti jompo.',
            'verifikasi_admin' => [
                'status' => 'setuju',
                'catatan' => 'Berkas identitas terverifikasi lengkap.',
                'tanggal' => now()->subDays(3)->toDateTimeString(),
                'verifikator' => 'Petugas Verifikator',
            ],
            'kondisi_sosial' => [
                'catatan' => 'Kunjungan lapangan mengonfirmasi klien benar-benar tidak memiliki wali dan tinggal di tempat tidak layak.',
                'tanggal' => now()->subDays(2)->toDateTimeString(),
                'petugas' => 'Petugas Wilayah Dinsos',
            ],
            'status_workflow' => 'proses_asesmen',
        ]);

        // Kasus 3: Disabilitas Fisik (Proses Rekomendasi)
        RehabilitasiSosial::create([
            'user_id' => $pemohon->id,
            'kategori' => 'disabilitas',
            'nama_klien' => 'Aditya Pratama',
            'nik' => '1203010506080004',
            'kab_kota' => 'Kota Binjai',
            'alamat' => 'Jl. Kartini Baru No. 89, Binjai',
            'deskripsi_kasus' => 'Remaja disabilitas daksa mengalami kesulitan mobilisasi untuk sekolah. Keluarga kurang mampu mengajukan bantuan kursi roda fisik.',
            'verifikasi_admin' => [
                'status' => 'setuju',
                'catatan' => 'Dokumen KK & surat keterangan miskin terlampir.',
                'tanggal' => now()->subDays(4)->toDateTimeString(),
                'verifikator' => 'Petugas Verifikator',
            ],
            'kondisi_sosial' => [
                'catatan' => 'Kondisi ekonomi keluarga benar prasejahtera, anak memerlukan alat bantu segera.',
                'tanggal' => now()->subDays(3)->toDateTimeString(),
                'petugas' => 'Petugas Wilayah Dinsos',
            ],
            'asesmen_kebutuhan' => [
                'analisis' => 'Klien membutuhkan kursi roda fisik anak ukuran standar agar dapat mandiri bersekolah.',
                'alat_bantu' => 'Kursi Roda Fisik Standar',
                'tanggal' => now()->subDays(2)->toDateTimeString(),
                'analis' => 'Analis Rehab Sosial',
            ],
            'status_workflow' => 'proses_rekomendasi',
        ]);

        // Kasus 4: Tuna Sosial Terlantar (Dirujuk ke UPTD)
        RehabilitasiSosial::create([
            'user_id' => $pemohon->id,
            'kategori' => 'tuna_sosial',
            'nama_klien' => 'Joko Susilo',
            'nik' => '3275031405780002',
            'kab_kota' => 'Kabupaten Langkat',
            'alamat' => 'Area Terminal Stabat, Langkat',
            'deskripsi_kasus' => 'Ditemukan menggelandang di jalan tanpa kartu identitas daerah. Mengaku terlantar dari pulau Jawa. Memerlukan pemulangan orang terlantar ke daerah asal.',
            'verifikasi_admin' => [
                'status' => 'setuju',
                'catatan' => 'Laporan kepolisian terlampir.',
                'tanggal' => now()->subDays(5)->toDateTimeString(),
                'verifikator' => 'Petugas Verifikator',
            ],
            'kondisi_sosial' => [
                'catatan' => 'Klien tinggal di emperan toko sekitar terminal stabat selama 2 bulan.',
                'tanggal' => now()->subDays(4)->toDateTimeString(),
                'petugas' => 'Petugas Wilayah Dinsos',
            ],
            'asesmen_kebutuhan' => [
                'analisis' => 'Memerlukan penampungan sementara dan koordinasi pemulangan orang terlantar antardinsos.',
                'alat_bantu' => '-',
                'tanggal' => now()->subDays(3)->toDateTimeString(),
                'analis' => 'Analis Rehab Sosial',
            ],
            'rekomendasi_layanan' => [
                'rekomendasi' => 'Rujuk ke UPTD Penampungan untuk pemulihan dan penyiapan tiket pemulangan.',
                'perlu_rujukan' => true,
                'nama_uptd_lembaga' => 'UPTD Pelayanan Anak Balita', // dummy
                'tanggal' => now()->subDays(2)->toDateTimeString(),
                'kasi' => 'Kasi Rehab Sosial',
            ],
            'perlu_rujukan' => true,
            'nama_uptd_lembaga' => 'UPTD Pelayanan Anak Balita',
            'status_penerimaan_uptd' => 'pending',
            'status_workflow' => 'dirujuk',
        ]);

        // Kasus 5: Korban Kekerasan & TPPO (Aktif Rehabilitasi di UPTD & Progress Log - 3.7)
        RehabilitasiSosial::create([
            'user_id' => $pemohon->id,
            'kategori' => 'kekerasan',
            'nama_klien' => 'Sari Indah',
            'nik' => '1212044809020005',
            'kab_kota' => 'Kota Pematangsiantar',
            'alamat' => 'Kecamatan Siantar Barat',
            'deskripsi_kasus' => 'Korban TPPO dipulangkan dari luar negeri dalam keadaan trauma berat. Membutuhkan pemulihan psikologis mendalam di rumah aman (safe house).',
            'verifikasi_admin' => [
                'status' => 'setuju',
                'catatan' => 'Pemeriksaan dokumen BP2MI terverifikasi lengkap.',
                'tanggal' => now()->subDays(10)->toDateTimeString(),
                'verifikator' => 'Petugas Verifikator',
            ],
            'kondisi_sosial' => [
                'catatan' => 'Klien dalam kondisi trauma kecemasan sosial tinggi.',
                'tanggal' => now()->subDays(8)->toDateTimeString(),
                'petugas' => 'Petugas Wilayah Dinsos',
            ],
            'asesmen_kebutuhan' => [
                'analisis' => 'Kebutuhan utama adalah terapi psikologis trauma, pengawasan medis, dan isolasi di rumah aman.',
                'alat_bantu' => '-',
                'tanggal' => now()->subDays(7)->toDateTimeString(),
                'analis' => 'Analis Rehab Sosial',
            ],
            'rekomendasi_layanan' => [
                'rekomendasi' => 'Rujuk ke UPTD Perlindungan Perempuan / Safe House untuk program pemulihan intensif.',
                'perlu_rujukan' => true,
                'nama_uptd_lembaga' => 'LKS Mitra Harapan Anak',
                'tanggal' => now()->subDays(6)->toDateTimeString(),
                'kasi' => 'Kasi Rehab Sosial',
            ],
            'perlu_rujukan' => true,
            'nama_uptd_lembaga' => 'LKS Mitra Harapan Anak',
            'status_penerimaan_uptd' => 'diterima',
            'catatan_uptd' => 'Kamar safe house tersedia, kuota gizi siap.',
            'progress_layanan' => [
                [
                    'tanggal' => now()->subDays(4)->toDateTimeString(),
                    'log' => 'Klien mulai mengikuti konseling psikologis sesi pertama. Respon awal masih tertutup.',
                    'petugas' => 'Lembaga UPTD Mitra',
                ],
                [
                    'tanggal' => now()->subDays(2)->toDateTimeString(),
                    'log' => 'Sesi konseling kedua. Klien mulai mau berkomunikasi dengan sesama penghuni safe house.',
                    'petugas' => 'Lembaga UPTD Mitra',
                ]
            ],
            'status_workflow' => 'diterima_mitra',
        ]);
    }
}
