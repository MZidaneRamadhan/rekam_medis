<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        User::create([
            'name' => 'John Doe',
            // 'username' => 'john_doe',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Jane Smith',
            // 'username' => 'jane_smith',
            'email' => 'jane@gmail.com',
            'password' => Hash::make('password456'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin1',
            // 'username' => 'jamal123',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'resepsionis',
        ]);
        User::create([
            'name' => 'Lab',
            // 'username' => 'jamal123',
            'email' => 'lab@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'lab',
        ]);
        User::create([
            'name' => 'apotek',
            // 'username' => 'jamal123',
            'email' => 'apotek@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'apoteker',
        ]);
        $user1 = User::create([
            'name' => 'Dr. Poli Gigi',
            'email' => 'poligigi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'poli_id' => '2',
            'user_id' => $user1->id,
            'nama_dokter' => $user1->name,
            'SIP' => $this->generateNomorSurat($faker),
            'telp' => $faker->phoneNumber(),
            'alamat' => $faker->address(),
        ]);
        $user2 = User::create([
            'name' => 'Dr. Poli Anak',
            'email' => 'polianak@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'poli_id' => '3',
            'user_id' => $user2->id,
            'nama_dokter' => $user2->name,
            'SIP' => $this->generateNomorSurat($faker),
            'telp' => $faker->phoneNumber(),
            'alamat' => $faker->address(),
        ]);
        $user3 = User::create([
            'name' => 'Dr. John Doe',
            'email' => 'dokterumum@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'poli_id' => '1',
            'user_id' => $user3->id,
            'nama_dokter' => $user3->name,
            'SIP' => $this->generateNomorSurat($faker),
            'telp' => $faker->phoneNumber(),
            'alamat' => $faker->address(),
        ]);
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
