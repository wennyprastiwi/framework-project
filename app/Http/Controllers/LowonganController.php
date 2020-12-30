<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use App\Models\Lowongan;
use App\Models\PenyediaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    private function getAdminData()
    {
      return $admin = Auth::user();
    }

    public static function get($filter = NULL)
    {
        if ($filter == NULL) {
            return Lowongan::all();
        }
        return Lowongan::where($filter)->get();
    }

    public function create()
    {
        $user = Auth::user();
        $ktgPekerjaan = KategoriPekerjaan::orderBy('nama_kategori_pekerjaan')->pluck('nama_kategori_pekerjaan', 'id');
        $penyediaKerja = PenyediaKerja::where('id_user', $user->id)->first();

        dd($penyediaKerja);

        return view('admin.lowongan.create', [
            'ktgPekerjaan' => $ktgPekerjaan,
            'penyediaKerja' => $penyediaKerja,
            'admin' => $this->getAdminData()
        ]);
    }
}
