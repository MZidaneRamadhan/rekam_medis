<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObatRM extends Model
{
    protected $table = 'obat_pasien';
    protected $fillable = [
        'rekam_medis_id',
        'obat_id',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class,'obat_id','id');
    }
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class,'rekam_medis_id','id');
    }
}
