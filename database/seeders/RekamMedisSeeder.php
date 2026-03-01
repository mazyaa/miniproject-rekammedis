<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekamMedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $pasienIds = Pasien::pluck('id')->toArray();
        $petugasIds = User::pluck('id')->toArray();

        if (empty($pasienIds) || empty($petugasIds)) {
            return;
        }

        for ($i = 1; $i <= 30; $i++) {
            // Spread created_at across last 6 months for chart data
            $createdAt = Carbon::now()->subMonths(rand(0, 5))->subDays(rand(0, 28));
            $tanggalKunjungan = $createdAt->copy()->subDays(rand(0, 7));

            DB::table('rekam_medis')->insert([
                'diastolik' => $faker->numberBetween(60, 90),
                'sistolik' => $faker->numberBetween(100, 160),
                'tanggal_kunjungan' => $tanggalKunjungan,
                'pasien_id' => $faker->randomElement($pasienIds),
                'petugas_id' => $faker->randomElement($petugasIds),
                'kepatuhan' => $faker->randomElement(['Patuh', 'Tidak Patuh', 'Cukup Patuh']),
                'obat_diberikan' => $faker->randomElement([
                    'Amlodipine 5mg',
                    'Captopril 25mg',
                    'Lisinopril 10mg',
                    'Losartan 50mg',
                    'Valsartan 80mg'
                ]),
                'keterangan' => $faker->randomElement([
                    'Kondisi stabil',
                    'Perlu kontrol ulang',
                    'Tekanan darah masih tinggi',
                    'Membaik dari kunjungan sebelumnya'
                ]),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
