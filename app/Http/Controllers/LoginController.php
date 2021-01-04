<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PenyediaKerja;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserBaru;

class LoginController extends Controller
{
    public function login()
    {
      return view('login');
    }

    public function register()
    {
      return view('registrasi');
    }

    public function store(Request $request)
    {
      $validateData = $this->validate($request, [
            'username' => 'required|unique:users',
            'email_user' => 'required|email|unique:users',
            'password' => 'required|same:repassword',
            'repassword' => 'required',
            'type' => 'required',
	    ]);

      $username = $request->username;
      $email_user  = $request->email_user;
      $password = $request->password;
      $type = $request->type;
      $status = 0;

      $saveData = User::create([
        'username' => $username,
        'email_user' => $email_user,
        'password' => Hash::make($password),
        'type' => $type,
        'status' => $status
      ]);
      $url = route('email.verify',$email_user);
      \Mail::to($email_user)
      ->send(new \App\Mail\VerifikasiMail($username, $url));
          return redirect()->route('login.login')
                          ->with('success','User berhasil dibuat. Silahkan cek email anda untuk verifikasi akun!');
    }

    public function authCheck(Request $request)
    {
      $validateData = $this->validate($request, [
        'identity' => 'required',
        'password' => 'required',
		  ]);

      $identity = $request->identity;
      $pass = $request->password;

      $useEmail = User::where('email_user', $identity)->first();
      $useUsername = User::where('username', $identity)->first();

          if($useEmail == NULL && $useUsername == NULL){
            return redirect('login')->with('failed','Akun tidak ditemukan');
          } else
          if($useEmail != NULL AND Hash::check($pass , $useEmail->password)){
            Auth::login($useEmail);
            $request->session()->regenerate();

            if($useEmail->type == 99){
              return redirect()->intended('admin');
            }else
            if ($useEmail->type == 2 && $useEmail->status == 1 ) {
              return redirect('perusahaan');
            }
            elseif ($useEmail->type == 1 && $useEmail->status == 1 ){
              return redirect('landing-page');
            }else {
              Auth::logout();
              $request->session()->invalidate();
              $request->session()->regenerateToken();
              return redirect('/login')->with('failed','Verifikasi email anda terlebih dahulu!');
            }
          } else
          if($useUsername != NULL AND Hash::check($pass , $useUsername->password)){
            Auth::login($useUsername);
            $request->session()->regenerate();

            if($useUsername->type == 99){
              return redirect()->intended('admin');
            }else
            if ($useUsername->type == 2 && $useUsername->status == 1 ) {
              return redirect('perusahaan');
            }
            elseif ($useUsername->type == 1 && $useUsername->status == 1) {
              return redirect('landing-page');
            }else {
              Auth::logout();
              $request->session()->invalidate();
              $request->session()->regenerateToken();
              return redirect('/login')->with('failed','Verifikasi email anda terlebih dahulu!');
            }
          } else {

            return redirect('login')->with('failed','Password salah');

          }
    }

    public function verifyEmail($email){
      $user = User::where('email_user',$email)->first();
      $user->status = 1;
      $user->email_verified_at = date('Y-m-d H:i:s');
      $user->save();

      return view('verifikasi');
    }

    public function logout(Request $request){
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/login');
    }
}
