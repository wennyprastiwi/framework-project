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
        'nama_pelatihan', 
        'bidang_keahlian', 
        'tahun_pelatihan', 
        'deskripsi_singkat_pelatihan'
    ];
}
