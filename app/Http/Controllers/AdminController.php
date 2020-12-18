<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function login()
    {
        return view('admin.login');
    }

    public function AuthCheck(Request $request) 
    {
        $this->validate($request,

          ['email_user'=>'required'],

          ['password'=>'required']
            
        );

        $user = $request->input('email_user');
        $pass = $request->input('password');

        $users = Admin::where('email_user', $user)->first();
          if($users == NULL){
        
            return redirect('/admin/login')->with('failed');
        
          } else
               
          if($users->email_user == $user AND $users->password == $pass ){
                    
            // Session::put('login', 'Selamat anda berhasil login');
            return redirect('admin');
        
          } else {
                     
            return redirect('/admin/login')->with('failed','Login gagal');
          
          }
    }
}
