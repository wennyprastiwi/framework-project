<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        ['email_user'=>'required'],

        ['password'=>'required']
            
      );

      $email = $request->input('email_user');
      $pass = $request->input('password');

      $users = User::where('email_user', $email)->first();
          if($users == NULL){
        
            return redirect('/login')->with('failed','Login gagal');
          } else
          if($users->email_user == $email AND $users->password == $pass){
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

      return redirect('/');
    }
}
