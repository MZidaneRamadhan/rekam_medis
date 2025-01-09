<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';
    protected $fillable = [
        'poli_id',
        'user_id',
        'nama_dokter',
        'SIP',
        'telp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function poli()
    {
        return $this->belongsTo(Poliklinik::class,'poli_id','id');
    }
}
