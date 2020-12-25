<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\JenisPendidikan;
use App\Models\Kota;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PencariKerjaController extends Controller
{
    private function getAdminData()
    {
      return $admin = Auth::user();
    }

    public static function get($filter = NULL) {
		if ($filter == NULL) {
			return PencariKerja::all();
		}
		return PencariKerja::where($filter)->get()->with(['admin' => $admin]);
    }

    public function create()
    {
        $jnsPendidikan = JenisPendidikan::all();
        $agama = Agama::all();
        $kota = Kota::all();
        return view('admin.pencari-kerja.create', ['jnsPendidikan' => $jnsPendidikan , 'agama' => $agama , 'kota' => $kota , 'admin' => $this->getAdminData()]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
