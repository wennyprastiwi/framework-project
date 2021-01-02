<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiLowongan extends Model
{
    use HasFactory;
    protected $table = 'lokasi_lowongan';
    protected $fillable = [
        'id_lokasi',
        'id_lowongan'
    ];

    public function kota()
    {
        return $this->belongsTo('App\Models\Kota', 'id_lokasi');
    }
}
