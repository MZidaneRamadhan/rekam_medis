<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Labolatorium extends Model
{
    use HasFactory;
    protected $table = 'labolatorium';
    protected $fillable = [
        'no_lab',
        'rekam_medis_id',
        'hasil_lab',
        'ket'
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class,'rekam_medis_id','id');
    }
}
