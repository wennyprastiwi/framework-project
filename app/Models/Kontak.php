<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;
    protected $table = 'kontak';
    protected $fillable = [
        'no_hp',
        'email',
        'jenis_kontak',
        'id_penyedia_kerja'
    ];
}
