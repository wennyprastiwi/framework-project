<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;
    protected $table = 'kontak';
    protected $fillable = [
        'id_kontak', 
        'no_hp', 
        'nama_email', 
        'nama_ig', 
        'nama_twitter', 
        'nama_linkedin', 
        'nama_facebook'
    ];
}
