<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Desa;
use App\Models\JenisKelamin;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {

            $tanggalLahir = Carbon::instance(
                $faker->dateTimeBetween('-70 years', '-1 years')
            );

            // Ambil jenis kelamin random dari database
            $jenisKelamin = JenisKelamin::inRandomOrder()->first();

            DB::table('pasien')->insert([
                'tanggal_lahir' => $tanggalLahir,
                'usia' => $tanggalLahir->age,
                'nik' => $faker->numerify('################'),
                'no_hp' => '08' . $faker->numerify('##########'),
                'nama_pasien' => $jenisKelamin->deskripsi === 'Laki-laki'
                    ? $faker->name('male')
                    : $faker->name('female'),
                'alamat' => $faker->address,
                'keterangan' => $faker->randomElement(['Hipertensi', 'Normal']),
                'desa_id' => Desa::inRandomOrder()->first()->id,
                'jenis_kelamin_id' => $jenisKelamin->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
