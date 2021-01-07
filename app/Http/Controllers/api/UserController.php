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

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_user' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $emailCredetials = request(['email_user', 'password']);

        if (!Auth::attempt($emailCredetials)) {
            return response()->json([
              'status_code' => 500,
              'message' => 'Unauthorized'
            ]);
        }

        $user = User::where('email_user', $request->email_user)->first();
        if ( ! Hash::check($request->password, $user->password, [])) {
            throw new \Exception('Error in Login');
        }

        $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'user' => $user
            ]);

    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if(!empty($user)) {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status_code' => 200,
                'message' => 'Logout Successfully',
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'User Not Found',
            ]);
        }

    }

    public function details()
    {
        $user = Auth::user();
        return response()->json([
            'success' => $user,
            'status_code' => 200,
        ]);
    }
}
