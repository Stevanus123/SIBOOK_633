<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'judul' => 'Laravel untuk Pemula',
                'penulis' => 'Dian Prasetyo',
                'penerbit' => 'Informatika Press',
                'tahun_terbit' => 2022,
                'isbn' => '9781234567890',
                'jumlah_halaman' => 210,
                'harga' => 75000,
                'stok' => 10,
                'kategori_id' => 1,
                'diskon_id' => 2,
                'deskripsi' => 'Panduan dasar untuk memulai belajar Laravel.',
                'gambar' => 'gambar/no-image.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mastering PHP 8',
                'penulis' => 'Rina Sari',
                'penerbit' => 'CodeHouse',
                'tahun_terbit' => 2023,
                'isbn' => '9780987654321',
                'jumlah_halaman' => 320,
                'harga' => 95000,
                'stok' => 5,
                'kategori_id' => 2,
                'diskon_id' => 1,
                'deskripsi' => 'Buku lanjutan untuk menguasai PHP versi terbaru.',
                'gambar' => 'gambar/no-image.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Membangun REST API',
                'penulis' => 'Arif Hidayat',
                'penerbit' => 'DevBooks',
                'tahun_terbit' => 2021,
                'isbn' => '9781112223334',
                'jumlah_halaman' => 180,
                'harga' => 68000,
                'stok' => 12,
                'kategori_id' => 1,
                'diskon_id' => 2,
                'deskripsi' => 'Langkah demi langkah membangun RESTful API dengan Laravel.',
                'gambar' => 'gambar/no-image.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Desain Database Modern',
                'penulis' => 'Yusuf Akbar',
                'penerbit' => 'SQLindo',
                'tahun_terbit' => 2020,
                'isbn' => '9782223334445',
                'jumlah_halaman' => 250,
                'harga' => 85000,
                'stok' => 8,
                'kategori_id' => 3,
                'diskon_id' => 1,
                'deskripsi' => 'Dasar hingga mahir dalam merancang skema database relasional.',
                'gambar' => 'gambar/no-image.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Logika Algoritma dan Pemrograman',
                'penulis' => 'Budi Santosa',
                'penerbit' => 'Teknika Media',
                'tahun_terbit' => 2019,
                'isbn' => '9783334445556',
                'jumlah_halaman' => 300,
                'harga' => 79000,
                'stok' => 7,
                'kategori_id' => 2,
                'diskon_id' => 3,
                'deskripsi' => 'Materi logika dasar dan pemrograman dengan studi kasus praktis.',
                'gambar' => 'gambar/no-image.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
