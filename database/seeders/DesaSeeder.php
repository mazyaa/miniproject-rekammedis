<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('desa')->insert([
            [
                'nama_desa' => 'Pipitan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_desa' => 'Walantaka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_desa' => 'Sadik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_desa' => 'Pesangerahan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
