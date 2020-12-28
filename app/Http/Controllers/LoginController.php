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
      return view('admin.login')->with(['admin' => $admin]);
    }

    public function AuthCheck(Request $request)
    {
      $this->validate($request,

        ['username'=>'required'],

        ['password'=>'required']

      );

      $email = $request->input('username');
      $pass = $request->input('password');

      $users = User::where('username', $email)->first();
          if($users == NULL){

            return redirect('/login')->with('failed','Login gagal');
          } else
          if($users->username == $email && Hash::check($pass, $users->password)){
            Auth::login($users);
            $request->session()->regenerate();

            return redirect()->intended('admin');

          } else {

            return redirect('/login')->with('failed','Login gagal');

          }
    }

    public function logout(Request $request){
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/login');
    }
}
