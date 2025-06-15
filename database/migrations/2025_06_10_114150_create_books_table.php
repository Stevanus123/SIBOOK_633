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
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('buku_id');
            $table->string('judul', 100);
            $table->string('penulis', 100);
            $table->string('penerbit', 100);
            $table->integer('tahun_terbit');
            $table->string('isbn', 13)->unique();
            $table->integer('jumlah_halaman');
            $table->integer('harga');
            $table->integer('stok');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('diskon_id')->nullable();
            $table->longText('deskripsi');
            $table->string('gambar', 255);
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('categories')->onDelete('cascade');
            $table->foreign('diskon_id')->references('diskon_id')->on('diskon')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
