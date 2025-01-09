<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'tanggal_lahir',
        'tempat_lahir',
        'usia',
        'jenis_kelamin',
        'telp',
        'agama',
    ];


    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }
    public function getUsiaLengkapAttribute()
    {
        $tanggal_lahir = Carbon::parse($this->tanggal_lahir);
        $sekarang = Carbon::now();

        $diff = $tanggal_lahir->diff($sekarang);

        $tahun = $diff->y;
        $bulan = $diff->m;
        $hari = $diff->d;

        return "{$tahun} tahun, {$bulan} bulan, {$hari} hari";
    }
}
