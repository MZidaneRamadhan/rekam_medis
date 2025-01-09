<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(PoliSeeder::class);
        $this->call(TindakanSeeder::class);
        $this->call(PasienSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ObatSeeder::class);
        $this->call(DokterSeeder::class);


    }
}
