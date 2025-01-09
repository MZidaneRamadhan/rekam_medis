<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'obat';
    protected $fillable = [
        'nama_obat',
        'jumlah_obat',
        'harga'
    ];

    public function obatrm()
    {
        return $this->belongsToMany(RekamMedis::class, 'obat_pasien', 'obat_id', 'rekam_medis_id');
    }
}
