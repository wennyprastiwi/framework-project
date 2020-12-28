<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataPelatihan extends Model
{
    use HasFactory;
    protected $table = 'biodata_pelatihan';
    protected $fillable = [
        'id',
        'id_pencari_kerja',
        'nama_pelatihan',
        'tahun_pelatihan',
        'deskripsi_singkat'
    ];
}
