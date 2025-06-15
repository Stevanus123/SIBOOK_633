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
        Schema::create('diskon', function (Blueprint $table) {
            $table->bigIncrements('diskon_id');
            $table->string('nama_diskon', 75);
            $table->string('kode', 15);
            $table->longText('deskripsi');
            $table->float('persen');
            $table->date('tglMulai');
            $table->date('tglSelesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskon');
    }
};
