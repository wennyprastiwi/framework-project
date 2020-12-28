<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataPendidikan extends Model
{
    use HasFactory;
    protected $table = 'biodata_pendidikan';
    protected $fillable = [
        'id',
        'id_pencari_kerja',
        'nama_instansi',
        'pendidikan_terakhir',
        'tahun_masuk',
        'tahun_lulus'
    ];
}
