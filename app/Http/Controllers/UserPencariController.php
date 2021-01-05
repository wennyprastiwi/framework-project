<?php

namespace App\Http\Controllers;

use App\Models\LokasiLowongan;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPencariController extends Controller
{
    private function getUserData()
    {
      return Auth::user();
    }

    public function index()
    {
    //   $lowongan = Lowongan::all();

      $lowongan = DB::table('lowongan')
        ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
        ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
        ->whereRaw('tanggal_ditutup > now()')
        ->get();

      return view('index')->with([
          'user' => $this->getUserData(),
          'lowongan' => $lowongan,
        ]);
    }

    public function jobList()
    {
    //   $lowongan = Lowongan::all();

      $lowongan = DB::table('lowongan')
        ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
        ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
        ->whereRaw('tanggal_ditutup > now()')
        ->take(5)
        ->get();

      return view('list-job')->with([
          'user' => $this->getUserData(),
          'lowongan' => $lowongan,
        ]);
    }

    public function detailJob($id)
    {
      $lowongan = DB::table('lowongan')
        ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
        ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
        ->where(['lowongan.id' => $id])
        ->first();

      return view('detail-job')->with([
          'user' => $this->getUserData(),
          'lowongan' => $lowongan,
        ]);
    }
}
