<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poliklinik extends Model
{
    use HasFactory;
    protected $table = 'poliklinik';
    protected $fillable = [
        'nama_poli',
        'ruangan'
    ];

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class,'poli_id','id');
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class,'poli_id','id');
    }
}
