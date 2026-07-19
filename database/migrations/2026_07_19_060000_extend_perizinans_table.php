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
        Schema::table('perizinans', function (Blueprint $table) {
            if (!Schema::hasColumn('perizinans', 'nomor_izin')) {
                $table->string('nomor_izin')->nullable()->after('jenis_layanan');
            }
            if (!Schema::hasColumn('perizinans', 'tahap_verifikasi')) {
                $table->string('tahap_verifikasi')->default('sekretariat')->after('status');
            }
            if (!Schema::hasColumn('perizinans', 'perlu_perbaikan')) {
                $table->boolean('perlu_perbaikan')->default(false)->after('tahap_verifikasi');
            }
            if (!Schema::hasColumn('perizinans', 'catatan_perbaikan')) {
                $table->text('catatan_perbaikan')->nullable()->after('perlu_perbaikan');
            }
            if (!Schema::hasColumn('perizinans', 'data_tambahan')) {
                $table->json('data_tambahan')->nullable()->after('catatan_perbaikan');
            }
            if (!Schema::hasColumn('perizinans', 'tanggal_terbit')) {
                $table->date('tanggal_terbit')->nullable()->after('data_tambahan');
            }
            if (!Schema::hasColumn('perizinans', 'tanggal_kadaluarsa')) {
                $table->date('tanggal_kadaluarsa')->nullable()->after('tanggal_terbit');
            }
            if (!Schema::hasColumn('perizinans', 'qr_code_token')) {
                $table->string('qr_code_token')->nullable()->unique()->after('tanggal_kadaluarsa');
            }
            if (!Schema::hasColumn('perizinans', 'history_status')) {
                $table->json('history_status')->nullable()->after('qr_code_token');
            }
            if (!Schema::hasColumn('perizinans', 'konfirmasi_wilayah')) {
                $table->boolean('konfirmasi_wilayah')->default(false)->after('history_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perizinans', function (Blueprint $table) {
            $table->dropColumn([
                'nomor_izin',
                'tahap_verifikasi',
                'perlu_perbaikan',
                'catatan_perbaikan',
                'data_tambahan',
                'tanggal_terbit',
                'tanggal_kadaluarsa',
                'qr_code_token',
                'history_status',
                'konfirmasi_wilayah'
            ]);
        });
    }
};
