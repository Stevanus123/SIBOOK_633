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
        Schema::create('usul_terbit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('categories', 'kategori_id')->onDelete('cascade');
            $table->string('judul', 75);
            $table->text('sinopsis');
            $table->string('file_naskah', 255);
            $table->string('sampul', 255)->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usul_terbit');
    }
};
