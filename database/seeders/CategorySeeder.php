<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'nama_kategori' => 'Teknologi',
                'deskripsi' => 'Kategori yang membahas seputar teknologi terbaru, perangkat keras, dan perangkat lunak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Kesehatan',
                'deskripsi' => 'Informasi mengenai kesehatan, kebugaran, dan gaya hidup sehat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Pendidikan',
                'deskripsi' => 'Topik-topik seputar pendidikan, sekolah, dan pelatihan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Kuliner',
                'deskripsi' => 'Resep, ulasan makanan, dan dunia kuliner dari berbagai daerah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
