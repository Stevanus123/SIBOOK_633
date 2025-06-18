<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'nama' => 'Stevanus Denko',
                'username' => 'deden',
                'email' => 'stevanusdenko46@gmail.com',
                'password' => bcrypt('rahasia2025'),
                'no_telp' => '081234567890',
                'kota' => 'Jakarta',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Samuel Riguntoro',
                'username' => 'samuel',
                'email' => 'samuel@gmail.com',
                'password' => bcrypt('rahasia2025'),
                'no_telp' => '082345678901',
                'kota' => 'Bandung',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
