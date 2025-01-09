<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 1; $i <= 50; $i++) { // Menghasilkan 50 data
            $tanggal_lahir = $faker->date('Y-m-d', '2005-12-31'); // Maksimal lahir 31 Desember 2005
            $usia = Carbon::parse($tanggal_lahir)->age; // Hitung usia berdasarkan tanggal lahir

            Pasien::create([
                'nik'            => $faker->unique()->numerify('3217##########'),
                'nama'           => $faker->name(),
                'alamat'         => $faker->address(),
                'tanggal_lahir'  => $tanggal_lahir,
                'usia'           => $usia,
                'jenis_kelamin'  => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'telp'           => $faker->phoneNumber(),
                'agama'          => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'created_at'     => $faker->dateTimeBetween('2025-1-1', 'now'),
                'updated_at'     => now(),
            ]);
        }
    }
}
