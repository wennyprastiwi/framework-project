<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'biodata_pekerjaan';
    protected $fillable = [
        'id', 
        'nama_pekerjaan', 
        'tempat_pekerjaan'
    ];
}
