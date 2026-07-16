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
        // 1. Update users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nik')) {
                $table->string('nik', 16)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'no_kk')) {
                $table->string('no_kk', 16)->nullable()->after('nik');
            }
            if (!Schema::hasColumn('users', 'kontak')) {
                $table->string('kontak', 20)->nullable()->after('no_kk');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('kontak');
            }
        });


        // 3. Create profile_changes table
        Schema::create('profile_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('field_changed');
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_changes');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'no_kk', 'kontak', 'alamat']);
        });
    }
};
