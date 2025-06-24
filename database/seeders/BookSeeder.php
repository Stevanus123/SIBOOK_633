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
                'file_buku' => 'buku/laravel-untuk-pemula.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mastering PHP',
                'penulis' => 'Rizky Kurniawan',
                'penerbit' => 'TeknoMedia',
                'tahun_terbit' => 2023,
                'isbn' => '9780987654321',
                'jumlah_halaman' => 340,
                'harga' => 95000,
                'stok' => 8,
                'kategori_id' => 5,
                'diskon_id' => 3,
                'deskripsi' => 'Menguasai bahasa PHP dari dasar hingga lanjutan.',
                'gambar' => 'gambar/no-image.png',
                'file_buku' => 'buku/mastering-php.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Dasar-Dasar Data Science',
                'penulis' => 'Nadia Rahmawati',
                'penerbit' => 'DataBooks',
                'tahun_terbit' => 2021,
                'isbn' => '9781122334455',
                'jumlah_halaman' => 275,
                'harga' => 89000,
                'stok' => 12,
                'kategori_id' => 8,
                'diskon_id' => null,
                'deskripsi' => 'Pengenalan lengkap mengenai data science untuk pemula.',
                'gambar' => 'gambar/no-image.png',
                'file_buku' => 'buku/data-science-dasar.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'UI/UX Design Handbook',
                'penulis' => 'Fajar Nugroho',
                'penerbit' => 'CreativeLabs',
                'tahun_terbit' => 2024,
                'isbn' => '9786677889900',
                'jumlah_halaman' => 198,
                'harga' => 82000,
                'stok' => 7,
                'kategori_id' => 12,
                'diskon_id' => 5,
                'deskripsi' => 'Panduan terbaik dalam mendesain antarmuka pengguna.',
                'gambar' => 'gambar/no-image.png',
                'file_buku' => 'buku/uiux-handbook.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Belajar JavaScript Modern',
                'penulis' => 'Yusuf Hidayat',
                'penerbit' => 'WebCode ID',
                'tahun_terbit' => 2020,
                'isbn' => '9785544332211',
                'jumlah_halaman' => 310,
                'harga' => 77000,
                'stok' => 5,
                'kategori_id' => 3,
                'diskon_id' => null,
                'deskripsi' => 'JavaScript ES6 ke atas dalam praktik web modern.',
                'gambar' => 'gambar/no-image.png',
                'file_buku' => 'buku/js-modern.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Database dengan MySQL',
                'penulis' => 'Laila Afifah',
                'penerbit' => 'Sinar Informatika',
                'tahun_terbit' => 2023,
                'isbn' => '9783344556677',
                'jumlah_halaman' => 260,
                'harga' => 68000,
                'stok' => 9,
                'kategori_id' => 10,
                'diskon_id' => 1,
                'deskripsi' => 'Dasar-dasar membuat dan mengelola database menggunakan MySQL.',
                'gambar' => 'gambar/no-image.png',
                'file_buku' => 'buku/mysql-database.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
