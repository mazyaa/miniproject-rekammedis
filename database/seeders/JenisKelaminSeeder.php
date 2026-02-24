<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_kelamin')->insert([
            [
                'deskripsi' => 'Laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'deskripsi' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
