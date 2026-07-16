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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'account_type')) {
                $table->enum('account_type', ['masyarakat', 'lembaga'])->default('masyarakat')->after('role');
            }
            if (!Schema::hasColumn('users', 'nama_lembaga')) {
                $table->string('nama_lembaga')->nullable()->after('account_type');
            }
            if (!Schema::hasColumn('users', 'jenis_lembaga')) {
                $table->enum('jenis_lembaga', ['perusahaan', 'lks', 'instansi_pemerintah', 'organisasi_sosial'])->nullable()->after('nama_lembaga');
            }
            if (!Schema::hasColumn('users', 'no_akta')) {
                $table->string('no_akta')->nullable()->after('jenis_lembaga');
            }
            if (!Schema::hasColumn('users', 'npwp')) {
                $table->string('npwp', 16)->nullable()->after('no_akta');
            }
            if (!Schema::hasColumn('users', 'alamat_lembaga')) {
                $table->text('alamat_lembaga')->nullable()->after('npwp');
            }
            if (!Schema::hasColumn('users', 'dokumen_legalitas')) {
                $table->string('dokumen_legalitas')->nullable()->after('alamat_lembaga');
            }
            if (!Schema::hasColumn('users', 'validation_status')) {
                $table->enum('validation_status', ['pending', 'validated', 'rejected'])->default('pending')->after('dokumen_legalitas');
            }
            if (!Schema::hasColumn('users', 'validation_note')) {
                $table->text('validation_note')->nullable()->after('validation_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'account_type',
                'nama_lembaga',
                'jenis_lembaga',
                'no_akta',
                'npwp',
                'alamat_lembaga',
                'dokumen_legalitas',
                'validation_status',
                'validation_note',
            ]);
        });
    }
};
