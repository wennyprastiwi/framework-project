<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPendidikan extends Model
{
    use HasFactory;
    protected $table = 'jenis_pendidikan';
    protected $fillable = ['nama_jenis_pendidikan'];
}
