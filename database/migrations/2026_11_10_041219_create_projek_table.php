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
        Schema::create('projek', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel users
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Informasi Utama
            $table->string('nama_projek');
            $table->enum('kategori', ['Web App', 'Mobile App', 'UI/UX Design', 'Other'])->default('Web App');
            $table->string('peran')->nullable();       // Contoh: Fullstack Developer
            $table->string('teknologi')->nullable();   // Contoh: "Laravel, Vue.js, MySQL"

            // Detail & Media
            $table->string('logo')->nullable();        // Gambar/Thumbnail
            $table->text('deskripsi')->nullable();
            $table->string('link')->nullable();        // Link live demo
            $table->string('github_link')->nullable(); // Link repository

            // Fitur Tambahan
            $table->boolean('is_featured')->default(false); // Untuk pin/sorot di portofolio utama

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projek');
    }
};
