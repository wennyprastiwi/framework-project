<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataPendidikan extends Model
{
    use HasFactory;
    protected $table = 'biodata_pendidikan';
    protected $fillable = [
        'id_pendidikan', 
        'pendidikan_terakhir', 
        'tahun_lulus'
    ];
}
