<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TindakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tindakanMedis = [
            ['nama_tindakan' => 'Pemeriksaan Fisik', 'keterangan' => 'Pemeriksaan kondisi kesehatan pasien secara keseluruhan.'],
            ['nama_tindakan' => 'Injeksi (Suntikan)', 'keterangan' => 'Pemberian obat atau cairan melalui jarum suntik.'],
            ['nama_tindakan' => 'Infus', 'keterangan' => 'Pemberian cairan, obat, atau nutrisi melalui pembuluh darah.'],
            ['nama_tindakan' => 'Rontgen (X-Ray)', 'keterangan' => 'Pemeriksaan pencitraan untuk melihat kondisi tulang atau organ tubuh.'],
            ['nama_tindakan' => 'USG (Ultrasonografi)', 'keterangan' => 'Pemeriksaan organ dalam tubuh menggunakan gelombang suara.'],
            ['nama_tindakan' => 'EKG (Elektrokardiogram)', 'keterangan' => 'Merekam aktivitas listrik jantung untuk mendiagnosis gangguan jantung.'],
            ['nama_tindakan' => 'Pemasangan Kateter', 'keterangan' => 'Memasukkan selang kecil ke saluran kemih untuk mengeluarkan urin.'],
            ['nama_tindakan' => 'Pembersihan Luka', 'keterangan' => 'Membersihkan luka untuk mencegah infeksi dan mempercepat penyembuhan.'],
            ['nama_tindakan' => 'Penjahitan Luka', 'keterangan' => 'Menutup luka dengan jahitan untuk mempercepat penyembuhan.'],
            ['nama_tindakan' => 'Pemasangan Gips', 'keterangan' => 'Melindungi tulang yang patah agar tetap stabil selama penyembuhan.'],
            ['nama_tindakan' => 'Pemeriksaan Darah', 'keterangan' => 'Pengambilan sampel darah untuk analisis laboratorium.'],
            ['nama_tindakan' => 'Transfusi Darah', 'keterangan' => 'Pemberian darah atau produk darah dari donor ke pasien.'],
            ['nama_tindakan' => 'Endoskopi', 'keterangan' => 'Pemeriksaan organ dalam menggunakan kamera kecil.'],
            ['nama_tindakan' => 'Nebulizer', 'keterangan' => 'Pemberian obat melalui alat yang mengubah cairan menjadi uap untuk dihirup.'],
            ['nama_tindakan' => 'Cuci Darah (Hemodialisis)', 'keterangan' => 'Pembersihan darah dari racun menggunakan mesin untuk pasien gagal ginjal.'],
            ['nama_tindakan' => 'Operasi Minor', 'keterangan' => 'Prosedur bedah kecil seperti pengangkatan kista atau benjolan kecil.'],
            ['nama_tindakan' => 'Aspirasi Cairan', 'keterangan' => 'Pengambilan cairan dari tubuh menggunakan jarum.'],
            ['nama_tindakan' => 'Imunisasi/Vaksinasi', 'keterangan' => 'Pemberian vaksin untuk mencegah penyakit menular.'],
            ['nama_tindakan' => 'Skrining Kanker', 'keterangan' => 'Pemeriksaan untuk mendeteksi kanker pada tahap awal.'],
            ['nama_tindakan' => 'Pemasangan NGT (Nasogastric Tube)', 'keterangan' => 'Memasukkan selang melalui hidung ke lambung untuk pemberian makanan atau obat.'],
        ];

        DB::table('tindakan')->insert($tindakanMedis);
    }
}
