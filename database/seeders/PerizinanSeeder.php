<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perizinan;
use App\Models\User;
use Illuminate\Support\Str;

class PerizinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Siti Aminah (Pemohon UGB) - Sedang di Sekretariat
        Perizinan::create([
            'pemohon_id' => 2,
            'jenis_layanan' => 'ugb',
            'status' => 'diperiksa',
            'tahap_verifikasi' => 'sekretariat',
            'perlu_perbaikan' => false,
            'konfirmasi_wilayah' => false,
            'data_tambahan' => [
                'nama_penyelenggara' => 'PT. Makmur Sentosa',
                'nama_undian' => 'Gebyar Hadiah Merdeka 2026',
                'total_hadiah' => '150000000',
                'waktu_pelaksanaan' => '17 Agustus 2026',
                'deskripsi_kegiatan' => 'Undian gratis berhadiah bagi pembeli produk elektronik merk Makmur di wilayah Sumatera Utara dengan hadiah utama mobil.',
            ],
            'history_status' => [
                [
                    'tahap' => 'Pengajuan',
                    'oleh' => 'Siti Aminah',
                    'role' => 'Pemohon',
                    'status' => 'diperiksa',
                    'catatan' => 'Permohonan UGB diajukan secara online.',
                    'waktu' => now()->subDays(2)->format('Y-m-d H:i:s'),
                ]
            ],
        ]);

        // 2. Ahmad Hidayat (Pemohon PUB) - Sedang di Verifikator
        Perizinan::create([
            'pemohon_id' => 3,
            'jenis_layanan' => 'pub',
            'status' => 'diperiksa',
            'tahap_verifikasi' => 'verifikator',
            'perlu_perbaikan' => false,
            'konfirmasi_wilayah' => true,
            'data_tambahan' => [
                'nama_penyelenggara' => 'Yayasan Peduli Anak Bangsa',
                'tujuan_pengumpulan' => 'Beasiswa Pendidikan 1000 Anak Yatim Piatu',
                'metode_pengumpulan' => 'Transfer Bank & Crowdfunding Online',
                'target_dana' => '500000000',
                'wilayah_pengumpulan' => 'Provinsi Sumatera Utara',
                'waktu_pelaksanaan' => '1 Agustus s.d. 31 Oktober 2026',
            ],
            'history_status' => [
                [
                    'tahap' => 'Pengajuan',
                    'oleh' => 'Ahmad Hidayat',
                    'role' => 'Pemohon',
                    'status' => 'diperiksa',
                    'catatan' => 'Permohonan PUB diajukan secara online.',
                    'waktu' => now()->subDays(3)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Sekretariat / Operator',
                    'status' => 'Lengkap',
                    'catatan' => 'Dokumen lengkap, diteruskan ke Verifikator Administrasi.',
                    'waktu' => now()->subDays(2)->format('Y-m-d H:i:s'),
                ]
            ],
        ]);

        // 3. Dewi Lestari (Pemohon LKS) - Sedang di Dinsos Wilayah
        Perizinan::create([
            'pemohon_id' => 4,
            'jenis_layanan' => 'lks',
            'status' => 'diperiksa',
            'tahap_verifikasi' => 'dinsos_wilayah',
            'perlu_perbaikan' => false,
            'konfirmasi_wilayah' => true,
            'data_tambahan' => [
                'nama_lks' => 'LKS Asy-Syifa',
                'jenis_pelayanan' => 'Rehabilitasi Sosial Penyandang Disabilitas',
                'nama_pimpinan' => 'Dewi Lestari, S.Sos',
                'jumlah_binaan' => '35',
                'alamat_lks' => 'Jl. Karya Bakti No. 12, Pematangsiantar',
            ],
            'history_status' => [
                [
                    'tahap' => 'Pengajuan',
                    'oleh' => 'Dewi Lestari',
                    'role' => 'Pemohon',
                    'status' => 'diperiksa',
                    'catatan' => 'Permohonan LKS diajukan secara online.',
                    'waktu' => now()->subDays(4)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Sekretariat / Operator',
                    'status' => 'Lengkap',
                    'catatan' => 'Dokumen lengkap, diteruskan ke Verifikator.',
                    'waktu' => now()->subDays(3)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Verifikator Administrasi',
                    'status' => 'Valid',
                    'catatan' => 'Legalitas akta pendirian tervalidasi. Diteruskan ke Dinsos Wilayah Pematangsiantar.',
                    'waktu' => now()->subDays(2)->format('Y-m-d H:i:s'),
                ]
            ],
        ]);

        // 4. Rian Wijaya (Pemohon Adopsi) - Sedang di Kepala Dinas
        Perizinan::create([
            'pemohon_id' => 5,
            'jenis_layanan' => 'adopsi',
            'status' => 'diperiksa',
            'tahap_verifikasi' => 'kepala_dinas',
            'perlu_perbaikan' => false,
            'konfirmasi_wilayah' => true,
            'data_tambahan' => [
                'nama_ayah' => 'Rian Wijaya',
                'nik_ayah' => '1271011212880002',
                'nama_ibu' => 'Siska Amelia',
                'nik_ibu' => '1271010304910003',
                'alamat_cota' => 'Jl. Setia Budi No. 192, Medan',
                'lama_menikah' => '8 Tahun',
                'penghasilan' => '25000000',
                'nama_anak' => 'Bayi laki-laki berusia 3 bulan',
                'alasan_adopsi' => 'Belum dikaruniai keturunan setelah 8 tahun pernikahan dan berkomitmen memberikan kasih sayang serta masa depan terbaik bagi anak.',
                'draft_nomor_rekomendasi' => 'REK-ADOPSI-2026-882',
                'draft_catatan_bidang' => 'Semua berkas lengkap. Hasil survei lapangan COTA dinyatakan layak secara ekonomi, mental, dan tempat tinggal. Layak disahkan.',
            ],
            'history_status' => [
                [
                    'tahap' => 'Pengajuan',
                    'oleh' => 'Rian Wijaya',
                    'role' => 'Pemohon',
                    'status' => 'diperiksa',
                    'catatan' => 'Permohonan adopsi diajukan secara online.',
                    'waktu' => now()->subDays(6)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Sekretariat / Operator',
                    'status' => 'Lengkap',
                    'catatan' => 'Dokumen kependudukan dan surat sehat lengkap.',
                    'waktu' => now()->subDays(5)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Verifikator Administrasi',
                    'status' => 'Valid',
                    'catatan' => 'Identitas kependudukan tervalidasi di Dukcapil.',
                    'waktu' => now()->subDays(4)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Dinsos Kab/Kota',
                    'status' => 'Layak',
                    'catatan' => 'Survei tempat tinggal disetujui. Layak secara material.',
                    'waktu' => now()->subDays(2)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Bidang Linjamsos',
                    'status' => 'Rekomendasi Disusun',
                    'catatan' => 'Draft rekomendasi adopsi selesai disusun. Diteruskan ke Kepala Dinas.',
                    'waktu' => now()->subDays(1)->format('Y-m-d H:i:s'),
                ]
            ],
        ]);

        // 5. Siti Aminah (UGB Terbit & Aktif) - SELESAI
        Perizinan::create([
            'pemohon_id' => 2,
            'jenis_layanan' => 'ugb',
            'status' => 'selesai',
            'tahap_verifikasi' => 'selesai',
            'perlu_perbaikan' => false,
            'nomor_izin' => '503/UGB/2026/0001',
            'tanggal_terbit' => now()->subDays(10),
            'tanggal_kadaluarsa' => now()->addMonths(3)->subDays(10),
            'qr_code_token' => 'ugbactive1234567890abcdefghijklm',
            'data_tambahan' => [
                'nama_penyelenggara' => 'PT. Sumber Alfaria',
                'nama_undian' => 'Semarak Hadiah Belanja Alfamart',
                'total_hadiah' => '75000000',
                'waktu_pelaksanaan' => '10 Juli 2026',
                'deskripsi_kegiatan' => 'Undian belanja sembako berhadiah peralatan dapur untuk wilayah kota Medan.',
            ],
            'history_status' => [
                [
                    'tahap' => 'Pengajuan',
                    'oleh' => 'Siti Aminah',
                    'role' => 'Pemohon',
                    'status' => 'diperiksa',
                    'waktu' => now()->subDays(12)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Kepala Dinas',
                    'status' => 'Disetujui',
                    'catatan' => 'Dokumen resmi diterbitkan.',
                    'waktu' => now()->subDays(10)->format('Y-m-d H:i:s'),
                ]
            ],
        ]);

        // 6. Ahmad Hidayat (LKS Kadaluarsa) - SELESAI & KADALUARSA
        Perizinan::create([
            'pemohon_id' => 3,
            'jenis_layanan' => 'lks',
            'status' => 'selesai',
            'tahap_verifikasi' => 'selesai',
            'perlu_perbaikan' => false,
            'nomor_izin' => '503/LKS/2023/0005',
            'tanggal_terbit' => now()->subYears(3)->subDays(5),
            'tanggal_kadaluarsa' => now()->subDays(5), // Kadaluarsa 5 hari lalu
            'qr_code_token' => 'lksexpired9876543210zyxwvutsrqpo',
            'data_tambahan' => [
                'nama_lks' => 'LKS Bhakti Abadi',
                'jenis_pelayanan' => 'Pelayanan Lanjut Usia Panti Jompo',
                'nama_pimpinan' => 'Ahmad Hidayat',
                'jumlah_binaan' => '50',
                'alamat_lks' => 'Jl. Asahan Km 4.5, Simalungun',
            ],
            'history_status' => [
                [
                    'tahap' => 'Pengajuan',
                    'oleh' => 'Ahmad Hidayat',
                    'role' => 'Pemohon',
                    'status' => 'diperiksa',
                    'waktu' => now()->subYears(3)->subDays(10)->format('Y-m-d H:i:s'),
                ],
                [
                    'tahap' => 'Verifikasi',
                    'oleh' => 'Budi Santoso',
                    'role' => 'Kepala Dinas',
                    'status' => 'Disetujui',
                    'catatan' => 'Operasional LKS diakui dan tanda daftar diterbitkan selama 3 tahun.',
                    'waktu' => now()->subYears(3)->subDays(5)->format('Y-m-d H:i:s'),
                ]
            ],
        ]);
    }
}
