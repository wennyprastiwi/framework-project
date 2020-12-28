<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController as userCtrl;
use App\Http\Controllers\KategoriPekerjaanController as ktgPekerjaanCtrl;
use App\Http\Controllers\PencariKerjaController as pncrKerjaCtrl;
use App\Http\Controllers\PenyediaKerjaController as pnydKerjaCtrl;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

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
		$pencariKerja = pncrKerjaCtrl::get();
		return view('admin.pencari-kerja.index')->with(['pencariKerja' => $pencariKerja]);
    }


    public function aboutUs() {
		return view('admin.about-us');
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

    public function AuthCheck(Request $request)
    {
        $this->validate($request,

          ['username'=>'required'],

          ['password'=>'required']

        );

        $user = $request->input('username');
        $pass = $request->input('password');

        $users = Admin::where('username', $user)->first();
          if(!empty($users)){
                return redirect('/admin/login')->with('failed');
          } else {

          if($users->username == $user && Hash::check($pass, $users->password) ){

            // Session::put('login', 'Selamat anda berhasil login');
            return redirect('admin');

          } else {

            return redirect('/admin/login')->with('failed','Login gagal');
          }
        }
    }
}
