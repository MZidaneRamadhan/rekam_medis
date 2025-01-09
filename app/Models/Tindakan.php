<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tindakan extends Model
{
    use HasFactory;
    protected $table = 'tindakan';
    protected $fillable = [
        'nama_tindakan',
        'keterangan'
    ];


    public function rekammedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}
