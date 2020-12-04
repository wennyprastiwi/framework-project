<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = [
        'id_lokasi', 
        'nama_lokasi', 
        'id_provinsi', 
        'id_kota', 
        'id_kecamatan', 
        'id_kelurahan'
    ];
}
