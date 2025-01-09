<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 2; $i++) {
            $user = User::create([
                'name' => $faker->name(),
                'email' => 'dokter'. $i . '@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'dokter',
            ]);

            Dokter::create([
                'poli_id' => $faker->randomElement(DB::table('poliklinik')->pluck('id')->toArray()),
                'user_id' => $user->id,
                'nama_dokter' => $user->name,
                'SIP' => $this->generateNomorSurat($faker),
                'telp' => $faker->phoneNumber(),
                'alamat' => $faker->address(),
            ]);
        }
    }
    private function generateNomorSurat($faker)
    {
        $nomor = $faker->numberBetween(100, 999); // Contoh: 197
        $kode1 = $faker->regexify('[A-Z]{3}'); // Contoh: KPG
        $kode2 = $faker->regexify('[0-9]{2}'); // Contoh: 02
        $kode3 = $faker->regexify('[A-Z]{4}'); // Contoh: PPIK
        $tahun = $faker->year; // Contoh: 2022

        return "$nomor/$kode1.$kode2/$kode3/$tahun";
    }
}
