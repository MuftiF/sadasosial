<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patroli_ugb', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            // Rencana Patroli
            $table->date('tanggal_rencana');
            $table->string('lokasi');
            $table->json('pembagian_tugas')->nullable(); // [{nama, jabatan, tugas}]
            $table->string('nomor_surat_tugas')->nullable();
            // Temuan Pelanggaran (bisa diisi saat rencana atau pelaksanaan)
            $table->string('nama_penyelenggara_temuan')->nullable();
            $table->string('jenis_pelanggaran')->nullable(); // tidak_berizin, terlambat_lapor, dll
            $table->string('bukti_foto_temuan')->nullable();
            $table->date('tanggal_temuan')->nullable();
            // Pelaksanaan Patroli
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->json('checklist_kondisi')->nullable(); // [{item, status, catatan}]
            $table->text('catatan_pembinaan')->nullable();
            $table->json('foto_dokumentasi')->nullable(); // [file_path, ...]
            // Laporan Hasil
            $table->text('ringkasan_temuan')->nullable();
            $table->text('tindakan_diambil')->nullable();
            $table->text('rekomendasi')->nullable();
            // Status
            $table->enum('status', ['rencana', 'pelaksanaan', 'selesai'])->default('rencana');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patroli_ugb');
    }
};
