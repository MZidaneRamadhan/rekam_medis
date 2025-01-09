<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'kunjungan';
    protected $fillable = [
        'pasien_id',
        'poli_id',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'status_kunjungan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function poli()
    {
        return $this->belongsTo(Poliklinik::class);
    }
}
