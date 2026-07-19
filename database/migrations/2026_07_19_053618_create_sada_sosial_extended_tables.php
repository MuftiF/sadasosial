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
        // 1. Table for profile update requests
        Schema::create('profile_update_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->json('requested_changes'); // Stores the requested new values (e.g. {"name": "New Name"})
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        // 2. Table for external data validation logs
        Schema::create('data_validation_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('source'); // Dukcapil, SIKS-NG, AHU, OSS, NPWP, etc.
            $table->string('status'); // matched, mismatch
            $table->foreignId('checked_by')->constrained('users')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->json('raw_response')->nullable();
            $table->timestamps();
        });

        // 3. Table for access control audit logs
        Schema::create('access_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('target_user_id')->constrained('users')->onDelete('cascade');
            $table->string('action'); // e.g., 'role_update', 'activation_update'
            $table->text('details');  // e.g., 'Changed role from user to admin'
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_audit_logs');
        Schema::dropIfExists('data_validation_logs');
        Schema::dropIfExists('profile_update_requests');
    }
};
