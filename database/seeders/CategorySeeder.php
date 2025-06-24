<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Agama Islam', 'Arsitektur', 'Bahasa dan Sastra', 'Biologi', 'Bisnis',
            'Ekonomi', 'Farmasi', 'Filsafat', 'Geografi', 'Hukum',
            'Ilmu Komputer', 'Ilmu Terapan', 'Kebidanan', 'Kedokteran', 'Keguruan & Ilmu Pendidikan',
            'Kehutanan', 'Keperawatan', 'Kesehatan', 'Kimia', 'Komunikasi',
            'Manajemen', 'Matematika', 'Metodologi Penelitian', 'Motivasi', 'Novel',
            'Pendidikan', 'Buku Penerbangan', 'Perikanan dan Kelautan', 'Pertanian', 'Peternakan',
            'Psikologi', 'Resep', 'Sains dan Teknologi', 'Sosial Budaya', 'Sosial dan Politik',
            'Teknik', 'Sejarah',
        ];

        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'nama_kategori' => $category,
                'deskripsi' => 'Kategori tentang ' . strtolower($category) . '.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categories')->insert($data);
    }
}
