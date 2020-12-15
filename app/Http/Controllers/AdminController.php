<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController as userCtrl;
use App\Models\KategoriPekerjaan as ktgPekerjaanCtrl;
use App\Models\PenyediaKerja as pnydKerjaCtrl;

class AdminController extends Controller
{
  function __construct()
    {
      $this->middleware('admin');
    }

    public function index()
    {
        $admin = Auth::user();
        return view('admin.dashboard')->with(['admin' => $admin]);

    }

    public function user() {
		$user = userCtrl::get();
		return view('admin.users.index')->with(['user' => $user]);
    }

    public function kategoriPekerjaan() {
		$ktgPekerjaan = ktgPekerjaanCtrl::get();
		return view('admin.kategori-pekerjaan.index')->with(['ktgPekerjaan' => $ktgPekerjaan]);
	}

    public function penyediaKerja() {
		$penyediaKerja = pnydKerjaCtrl::get();
		return view('admin.penyedia-kerja.index')->with(['penyediaKerja' => $penyediaKerja]);
    }
    
    public function pencariKerja() {
		return view('admin.pencari-kerja');
    }
    
    public function lokasi() {
		return view('admin.lokasi');
    }
    
    public function aboutUs() {
		return view('admin.about-us');
    }
    
    public function kontak() {
		return view('admin.contact');
    }
    
    public function pushNotifikasi() {
		return view('admin.push-notifikasi');
	}

    public function profile()
    {
      return view('admin.profile');
    }

    public function setting()
    {
      return view('admin.setting');
    }

}
