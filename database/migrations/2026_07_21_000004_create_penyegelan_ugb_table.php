<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyegelan_ugb', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perizinan_id')->constrained('perizinans')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_penyegelan')->nullable();
            // Langkah 2: Saksi
            $table->json('saksi')->nullable(); // [{nama, jabatan, instansi}]
            // Langkah 3: Surat tugas petugas penyegelan
            $table->string('nomor_surat_tugas')->nullable();
            $table->json('petugas_penyegelan')->nullable(); // [{nama, nip, jabatan}]
            // Langkah 4-8: Checklist
            $table->json('checklist_data')->nullable();
            // {
            //   verif_izin: bool, verif_izin_catatan: string,
            //   saksi_hadir: bool,
            //   alat_dicek: bool, alat_catatan: string,
            //   uji_coba_selesai: bool,
            //   segel_terpasang: bool,
            //   tatib_dibaca: bool,
            //   undian_selesai: bool
            // }
            $table->string('foto_segel')->nullable();        // foto stiker segel terpasang
            $table->text('hasil_uji_coba')->nullable();      // hasil uji coba alat pengundian
            $table->json('daftar_pemenang')->nullable();     // [{nama, hadiah, nomor_undian}]
            $table->text('catatan')->nullable();
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyegelan_ugb');
    }
};
