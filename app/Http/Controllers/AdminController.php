<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan as mKP;
use App\Models\PenyediaKerja as mPK;
use App\Models\PencariKerja as mPencari;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController as userCtrl;
use App\Http\Controllers\KategoriPekerjaanController as ktgPekerjaanCtrl;
use App\Http\Controllers\PencariKerjaController as pncrKerjaCtrl;
use App\Http\Controllers\PenyediaKerjaController as pnydKerjaCtrl;
use App\Http\Controllers\LowonganController as lwngCtrl;
use App\Models\User;

class AdminController extends Controller
{
  function __construct()
  {
    $this->middleware('admin');
  }

  private function getAdminData()
  {
    return $admin = Auth::user();
  }

  public function getNotif(){
    return User::find($this->getAdminData()->id);
  }

    public function index()
    {


      return view('admin.dashboard')
        ->with(['admin' => $this->getAdminData(),
                'jmlUser' => User::count(),
                'jmlKP' => mKP::count(),
                'jmlPK' => mPK::count(),
                'jmlPencari' => mPencari::count(),
                'user' => $this->getNotif(),
                ]);
    }

    public function user() {
		$user = userCtrl::get();
		return view('admin.users.index')->with(['user' => $user, 'admin' => $this->getAdminData()]);
    }

    public function kategoriPekerjaan() {
		$ktgPekerjaan = ktgPekerjaanCtrl::get();
		return view('admin.kategori-pekerjaan.index')->with(['ktgPekerjaan' => $ktgPekerjaan, 'admin' => $this->getAdminData()]);
	  }

    public function penyediaKerja() {
		$penyediaKerja = pnydKerjaCtrl::get();
		return view('admin.penyedia-kerja.index')->with(['penyediaKerja' => $penyediaKerja, 'admin' => $this->getAdminData()]);
    }

    public function pencariKerja() {
		$pencariKerja = pncrKerjaCtrl::get();
		return view('admin.pencari-kerja.index')->with(['pencariKerja' => $pencariKerja, 'admin' => $this->getAdminData()]);
    }

    public function lowongan() {
		$lowongan = lwngCtrl::get();
		return view('admin.lowongan.index')->with(['lowongan' => $lowongan, 'admin' => $this->getAdminData()]);
    }


    public function aboutUs() {
      $about = AboutUs::all()->sortByDesc('id')->first();
      return view('admin.about-us')
            ->with([
              'admin' => $this->getAdminData(), 
              'about' => $about
              ]);
    }

    public function aboutUsStore(Request $request) {
      $validateData = $this->validate($request, [
        'sejarah' => 'required',
        'visi' => 'required',
        'misi' => 'required',
        'kontak' => 'required',
      ]);
      $sejarah = $request->sejarah;
      $visi = $request->visi;
      $misi = $request->misi;
      $kontak = $request->kontak;

      $saveData = AboutUs::create([
              'sejarah' => $sejarah,
              'visi' => $visi,
              'misi' => $misi,
              'kontak' => $kontak,
          ]);
      $about = AboutUs::all()->sortByDesc('id')->first();
      return view('admin.about-us')->with(['admin' => $this->getAdminData(), 'about' => $about]);
    }

    public function pushNotifikasi() {
		return view('admin.push-notifikasi')->with(['admin' => $this->getAdminData()]);
	  }

    public function profile()
    {
      return view('admin.profile')->with(['admin' => $this->getAdminData()]);
    }

    public function profileEdit()
    {
      return view('admin.profile-edit')->with(['admin' => $this->getAdminData()]);
    }

    public function profileUpdate(Request $request)
    {
          $id = $request->id;

          $username = $request->username;
          $email_user = $request->email_user;

          if($username != NULL){
              $saveData = User::where('id', $id)
              ->update(['username' => $username]);
          }
          if($email_user != NULL){
              $saveData = User::where('id', $id)
              ->update(['email_user' => $email_user]);
          }

          return redirect()->route('admin.profile')
                          ->with('update-user-success','Update User berhasil!');
    }

    public function updatePassword(Request $request)
    {
      $id = $request->id;

      $validateData = $this->validate($request, [
        'password' => 'required|same:repassword',
        'repassword' => 'required',
      ]);

      $password = $request->password;

      $saveData = User::where('id', $id)
        ->update(['password' => Hash::make($password)]);
      return redirect()->route('admin.profile')
                       ->with('update-pass-success','Ubah password berhasil');
    }

    public function setting()
    {
      return view('admin.setting')->with(['admin' => $this->getAdminData()]);
    }
}
