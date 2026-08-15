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
        Schema::create('rehabilitasi_sosials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kategori'); // anak, lansia, disabilitas, tuna_sosial, kekerasan, napza
            $table->string('nama_klien');
            $table->string('nik')->nullable();
            $table->string('kab_kota')->nullable();
            $table->text('alamat')->nullable();
            $table->text('deskripsi_kasus');
            $table->string('dokumen_pendukung')->nullable();

            // Tahapan Evaluasi Workflow (Disimpan dalam JSON untuk kemudahan histori detail)
            $table->json('verifikasi_admin')->nullable();      // verifikator
            $table->json('kondisi_sosial')->nullable();        // dinsos kab/kota
            $table->json('asesmen_kebutuhan')->nullable();      // analis
            $table->json('rekomendasi_layanan')->nullable();    // kasi

            // Rujukan UPTD / Lembaga Layanan
            $table->boolean('perlu_rujukan')->default(false);
            $table->string('nama_uptd_lembaga')->nullable();
            $table->string('status_penerimaan_uptd')->default('pending'); // pending, diterima, ditolak
            $table->text('catatan_uptd')->nullable();
            $table->text('alternatif_layanan')->nullable();
            
            // PB 3.7 Monitoring Rujukan (JSON progress log dari UPTD/Lembaga Mitra)
            $table->json('progress_layanan')->nullable(); 

            // Status Workflow Utama
            $table->string('status_workflow')->default('diajukan');
            // Status: diajukan, verifikasi_awal, proses_asesmen, proses_rekomendasi, dirujuk, diterima_mitra, ditolak_mitra, selesai_non_rujukan, selesai
            
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rehabilitasi_sosials');
    }
};
