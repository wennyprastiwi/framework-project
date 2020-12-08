<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController as userCtrl;
use App\Models\KategoriPekerjaan as ktgPekerjaanCtrl;
use App\Models\PenyediaKerja as pnydKerjaCtrl;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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

    public function profile()
    {
        return view('admin.profile');
    }

    public function setting()
    {
        return view('admin.setting');
    }

}
