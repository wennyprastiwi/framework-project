<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'kategori_pekerjaan';
    protected $fillable = [
        'id_kategori', 
        'nama_kategori_pekerjaan'
    ];
}
