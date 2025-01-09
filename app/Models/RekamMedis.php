<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    use HasFactory;
    protected $table = 'rekam_medis';
    protected $fillable = [
        'no_rm',
        'pasien_id',
        'dokter_id',
        'tindakan_id',
        'diagnosa',
        'keluhan',
        'resep',
        'tanggal_pemeriksaan',
        'ket',
        'status',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }
    public function obatrm()
    {
        return $this->belongsToMany(Obat::class, 'obat_pasien', 'rekam_medis_id', 'obat_id');
    }
    public function lab()
    {
        return $this->hasMany(Labolatorium::class,'rekam_medis_id','id');
    }
}
