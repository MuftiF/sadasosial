<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_acara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perizinan_id')->constrained('perizinans')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');
            $table->enum('jenis_pemeriksaan', ['lapangan', 'dokumen', 'virtual'])->default('lapangan');
            $table->text('hasil_pemeriksaan');
            $table->enum('rekomendasi', ['terbitkan', 'tolak', 'perbaikan']);
            $table->text('catatan_tambahan')->nullable();
            // Tanda tangan elektronik: nama + NIP + timestamp
            $table->json('tanda_tangan')->nullable(); // {nama, nip, jabatan, timestamp}
            $table->enum('status', ['draft', 'final'])->default('draft');
            // Checklist lapangan (opsional, untuk pemeriksaan fisik)
            $table->json('checklist_lapangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_acara');
    }
};
