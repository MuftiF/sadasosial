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
            $table->string('laporan_status')->nullable()->after('konfirmasi_wilayah');
            $table->timestamp('laporan_submitted_at')->nullable()->after('laporan_status');
            $table->json('laporan_data')->nullable()->after('laporan_submitted_at');
            $table->text('laporan_catatan')->nullable()->after('laporan_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perizinans', function (Blueprint $table) {
            $table->dropColumn([
                'laporan_status',
                'laporan_submitted_at',
                'laporan_data',
                'laporan_catatan',
            ]);
        });
    }
};
