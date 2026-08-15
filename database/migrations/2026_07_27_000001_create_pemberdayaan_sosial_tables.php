<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 2.1 Pembinaan Kelembagaan Sosial dan Organisasi Sosial
        Schema::create('pembinaan_kelembagaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lembaga');
            $table->string('jenis_lembaga'); // LKS, Orsos, dsb
            $table->string('nomor_registrasi')->nullable();
            $table->string('kab_kota')->nullable();
            $table->text('alamat_lembaga')->nullable();
            $table->string('dokumen_permohonan')->nullable();
            $table->text('usulan_pembinaan')->nullable();
            
            // Agenda & Pelaksanaan oleh Bidang Pemberdayaan
            $table->json('agenda_pembinaan')->nullable(); // tanggal, materi, tim pelaksana
            $table->date('tanggal_pembinaan')->nullable();
            $table->text('hasil_pembinaan')->nullable();
            $table->text('catatan_evaluasi')->nullable();
            $table->boolean('perlu_tindak_lanjut')->default(false);
            
            // Workflow Status
            $table->string('status_workflow')->default('diajukan');
            // Status: diajukan, rencana_pembinaan, dilaksanakan, diarsipkan_sekretariat, disetujui_kadinas, ditolak
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });

        // 2.2 Pembinaan Pilar-Pilar Sosial (PSM, TKSK, Karang Taruna, Relawan)
        Schema::create('pembinaan_pilars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kategori_pilar'); // psm, tksk, karang_taruna, relawan_sosial
            $table->string('nama_pilar');
            $table->string('kab_kota')->nullable();
            $table->text('usulan_pembinaan')->nullable();
            
            // Program Bimtek & Evaluasi oleh Bidang Pemberdayaan
            $table->json('program_bimtek')->nullable(); // judul, modul, narasumber, tanggal
            $table->date('tanggal_bimtek')->nullable();
            $table->integer('evaluasi_skor')->default(0);
            $table->text('catatan_evaluasi')->nullable();
            $table->boolean('perlu_pembinaan_lanjutan')->default(false);
            
            // Workflow Status
            $table->string('status_workflow')->default('diajukan');
            // Status: diajukan, diidentifikasi, bimtek_dilaksanakan, dievaluasi, diarsipkan_sekretariat, disahkan_kadinas, ditolak
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });

        // 2.3 Fasilitasi Pemberdayaan Komunitas / Kelompok Rentan
        Schema::create('fasilitasi_komunitases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_komunitas');
            $table->string('jenis_kelompok'); // lansia, disabilitas, gepeng, masyarakat_rentan
            $table->string('kab_kota')->nullable();
            $table->text('alamat')->nullable();
            $table->text('usulan_kebutuhan');
            
            // Verifikasi Dinsos Wilayah & Rencana Fasilitasi Bidang Pemberdayaan
            $table->string('status_verifikasi_dinsos')->default('pending'); // pending, diverifikasi, ditolak
            $table->text('catatan_verifikasi_dinsos')->nullable();
            $table->text('rencana_fasilitasi')->nullable();
            $table->text('hasil_monitoring')->nullable();
            $table->boolean('is_efektif')->default(false);
            
            // Workflow Status
            $table->string('status_workflow')->default('diajukan');
            // Status: diajukan, diverifikasi_wilayah, rencana_fasilitasi, dilaksanakan, monitoring, diarsipkan_sekretariat, disetujui_keberlanjutan, ditolak
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });

        // 2.4 Pengelolaan Kegiatan Kesetiakawanan, Restorasi & Penyuluhan Sosial
        Schema::create('kegiatan_kesetiakawanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('jenis_kegiatan'); // kesetiakawanan_sosial, restorasi_sosial, penyuluhan_sosial
            $table->string('judul_kegiatan');
            $table->string('tema')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kab_kota')->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->integer('target_peserta')->default(0);
            $table->string('narasumber')->nullable();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->string('foto_dokumentasi')->nullable();
            $table->text('laporan_kegiatan')->nullable();
            
            // Workflow Status
            $table->string('status_workflow')->default('rencana');
            // Status: rencana, peserta_ditetapkan, dilaksanakan, laporan_disusun, diarsipkan_sekretariat, disahkan_kadinas
            $table->timestamps();
        });

        Schema::create('kegiatan_pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan_kesetiakawanans')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_peserta');
            $table->string('instansi_unsur')->nullable();
            $table->string('kontak')->nullable();
            $table->string('status_kehadiran')->default('terdaftar'); // terdaftar, hadir, absent
            $table->timestamps();
        });

        // 2.5 Pengelolaan Kepahlawanan dan Taman Makam Pahlawan (TMP)
        Schema::create('pengelolaan_kepahlawanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('jenis_agenda'); // pemeliharaan_tmp, hari_pahlawan, usulan_gelar, ziarah_wisata
            $table->string('nama_tmp_atau_pahlawan');
            $table->string('lokasi_tmp')->nullable();
            $table->string('kab_kota')->nullable();
            $table->text('usulan_kegiatan');
            $table->text('agenda_ditentukan')->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->string('foto_dokumentasi')->nullable();
            $table->text('laporan_hasil')->nullable();
            
            // Workflow Status
            $table->string('status_workflow')->default('diajukan');
            // Status: diajukan, agenda_disusun, dilaksanakan, laporan_disusun, diarsipkan_sekretariat, disahkan_kadinas, ditolak
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });

        // 2.6 Monitoring dan Evaluasi (Monev) Program Pemberdayaan Sosial
        Schema::create('monev_pemberdayaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('periode_evaluasi'); // e.g. Triwulan I 2026
            $table->year('tahun');
            $table->string('kab_kota')->default('Seluruh Sumatera Utara');
            $table->integer('total_lks_dibina')->default(0);
            $table->integer('total_pilar_dibina')->default(0);
            $table->integer('total_komunitas_difasilitasi')->default(0);
            $table->integer('total_kegiatan_kesetiakawanan')->default(0);
            $table->integer('total_tmp_dikelola')->default(0);
            $table->text('capaian_program')->nullable();
            $table->text('kendala_program')->nullable();
            $table->text('rekomendasi_perbaikan')->nullable();
            
            // Workflow Status
            $table->string('status_workflow')->default('draft');
            // Status: draft, diolah, dianalisis, laporan_disusun, diarsipkan_sekretariat, disahkan_kadinas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monev_pemberdayaans');
        Schema::dropIfExists('pengelolaan_kepahlawanans');
        Schema::dropIfExists('kegiatan_pesertas');
        Schema::dropIfExists('kegiatan_kesetiakawanans');
        Schema::dropIfExists('fasilitasi_komunitases');
        Schema::dropIfExists('pembinaan_pilars');
        Schema::dropIfExists('pembinaan_kelembagaans');
    }
};
