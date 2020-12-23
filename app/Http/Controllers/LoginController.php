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
        $admin = Auth::user();
      return view('login')->with(['admin' => $admin]);
    }

    public function register()
    {
      return view('registrasi');
    }

    public function store(Request $request)
    {
      $validateData = $this->validate($request, [
			  'nama_user' => 'required',
        'email_user' => 'required|email|unique:users',
        'password' => 'required|same:repassword',
        'repassword' => 'required',
        'type' => 'required',
		  ]);

		  $nama_user = $request->nama_user;
      $email_user   = $request->email_user;
      $password = $request->password;
      $type = $request->type;

      $saveData = User::create([
        'nama_user' => $nama_user,
        'email_user' => $email_user,
        'password' => Hash::make($password),
        'type' => $type,
      ]);

          return redirect()->route('login.login')
                          ->with('success','User berhasil dibuat.');
    }

    public function AuthCheck(Request $request) 
    {
      $this->validate($request,

        ['email_user'=>'required'],

        ['password'=>'required']
            
      );

      $email = $request->input('email_user');
      $pass = $request->input('password');

      $users = User::where('email_user', $email)->first();
          if($users == NULL){
        
            return redirect('/login')->with('failed','Akun tidak ditemukan');
          } else
          if($users->email_user == $email AND Hash::check($pass , $users->password)){
            Auth::login($users);
            $request->session()->regenerate();

            if($users->type == 1){
              return redirect()->intended('admin');
            }else{
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
