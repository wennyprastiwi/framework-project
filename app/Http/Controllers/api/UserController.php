<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){
        $identity = request('identity');
        $pass = request('password');

        $useEmail = User::where('email_user', $identity)->first();
        $useUsername = User::where('email_user', $identity)->first();
        if($useUsername == NULL && $useEmail == NULL){
            return response()->json(['error'=>'Akun tidak ditemukan.'], 401);
        } else
        if($useEmail->email_user == $identity AND Hash::check($pass, $useEmail->password)){
            Auth::login($useEmail);
            $success['token'] =  $useEmail->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else
        if($useUsername->email_user == $identity AND Hash::check($pass, $useUsername->password)){
            Auth::login($useUsername);
            $success['token'] =  $useUsername->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {                    
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required',
            'username' => 'required|unique:users',
            'email_user' => 'required|email|unique:users',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['nama_user'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function logout(Request $request)
    {
        $logout = $request->user()->token()->revoke();
        if($logout){
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
