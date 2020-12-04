<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;
    protected $table = 'lamaran';
    protected $fillable = [
        'id_lamaran', 
        'id_lowongan', 
        'status_lamaran', 
        'id_pencari_kerja'
    ];
}
