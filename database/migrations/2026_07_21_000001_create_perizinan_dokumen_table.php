<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perizinan_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perizinan_id')->constrained('perizinans')->onDelete('cascade');
            $table->string('jenis_dokumen'); // e.g. akta_notaris, sk_kemenkumham, dll
            $table->string('nama_dokumen');  // label human-readable
            $table->string('file_path');
            $table->enum('status', ['uploaded', 'verified', 'rejected'])->default('uploaded');
            $table->text('catatan')->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perizinan_dokumen');
    }
};
