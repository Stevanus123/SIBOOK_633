<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('diskon')->insert([
            [
                'nama_diskon' => 'Bulan Juni',
                'kode' => 'JUNEBIGSALE',
                'deskripsi' => 'Diskon besar-besaran untuk bulan Juni.',
                'persen' => 20.0,
                'tglMulai' => '2025-06-01',
                'tglSelesai' => '2025-06-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_diskon' => 'Pengguna Baru',
                'kode' => 'WELCOME10',
                'deskripsi' => 'Diskon khusus untuk pengguna baru.',
                'persen' => 10.0,
                'tglMulai' => '2025-01-01',
                'tglSelesai' => '2025-12-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_diskon' => 'Bulan Ramadan',
                'kode' => 'RAMADAN30',
                'deskripsi' => 'Diskon spesial bulan Ramadan.',
                'persen' => 30.0,
                'tglMulai' => '2025-03-25',
                'tglSelesai' => '2025-04-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
