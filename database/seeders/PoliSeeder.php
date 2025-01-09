<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('poliklinik')->insert([
            [
                'nama_poli' => 'Poli Umum',
                'ruangan' => 'Ruang A1',
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'ruangan' => 'Ruang B2',
            ],
            [
                'nama_poli' => 'Poli Anak',
                'ruangan' => 'Ruang C3',
            ],
            [
                'nama_poli' => 'Poli Mata',
                'ruangan' => 'Ruang D4',
            ],
            [
                'nama_poli' => 'Poli Kulit',
                'ruangan' => 'Ruang E5',
            ],
        ]);
    }
}
