<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LowonganController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $user = Auth::user();
        $lowongan = DB::table('lowongan')
        ->leftJoin('penyedia_kerja', 'lowongan.id_penyedia_kerja', '=', 'penyedia_kerja.id')
        ->leftJoin('lokasi_lowongan', 'lowongan.id', '=', 'lokasi_lowongan.id_lowongan')
        ->leftJoin('indonesia_cities', 'lokasi_lowongan.id_lokasi', '=', 'indonesia_cities.id')
        ->leftJoin('lokasi_penyedia', 'penyedia_kerja.id', '=', 'lokasi_penyedia.id_penyedia_kerja')
        ->leftJoin('kontak', 'penyedia_kerja.id', '=', 'kontak.id_penyedia_kerja')
        ->select('lowongan.*', 'penyedia_kerja.nama_perusahaan', 'kontak.no_hp AS no_telephon','kontak.email','penyedia_kerja.deskripsi_perusahaan','indonesia_cities.name AS penempatan')
        ->get();
        return response()->json(['success' => $user, 'lowongan'=>$lowongan], $this->successStatus);
    }
}
