<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        'nama_user' => 'required',
        'username' => 'required|unique:users',
        'email_user' => 'required|email|unique:users',
        'password' => 'required|same:repassword',
        'repassword' => 'required',
        'type' => 'required',
		  ]);

      $nama_user = $request->nama_user;
      $username = $request->username;
      $email_user  = $request->email_user;
      $password = $request->password;
      $type = $request->type;

      $saveData = User::create([
        'nama_user' => $nama_user,
        'username' => $username,
        'email_user' => $email_user,
        'password' => Hash::make($password),
        'type' => $type,
      ]);

          return redirect()->route('login.login')
                          ->with('success','User berhasil dibuat.');
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
            return redirect('/login')->with('failed','Akun tidak ditemukan');
          } else
          if($useEmail != NULL AND Hash::check($pass , $useEmail->password)){
            Auth::login($useEmail);
            $request->session()->regenerate();

            if($useEmail->type == 99){
              return redirect()->intended('admin');
            }else 
            if ($useEmail->type == 2) {
              return redirect('perusahaan');
            }
            else{
              return redirect('landing-page');
            }
          } else 
          if($useUsername != NULL AND Hash::check($pass , $useUsername->password)){
            Auth::login($useUsername);
            $request->session()->regenerate();

            if($useUsername->type == 99){
              return redirect()->intended('admin');
            }else 
            if ($useUsername->type == 2) {
              return redirect('perusahaan');
            }
            else{
              return redirect('landing-page');
            }
          } else {
                     
            return redirect('/login')->with('failed','Password salah');
          
          }
    }

    public function logout(Request $request){
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/');
    }
}
