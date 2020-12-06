<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{

    public function index()
    {

        $user = DB::table('users')->get();
        return view('admin.users.index', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        DB::table('users')->insert([
			'nama_user' => $request->nama_user,
			'email_user' => $request->email_user,
            'password' => $request->password,
            'email_verified_at' => now(),
            'created_at' => date('Y-m-d H:i:s'),
            'remember_token' => Str::random(10),
		]);

        return redirect()->route('user.index')
                        ->with('success','User created successfully.');
    }

    public function show($id_users)
    {
        $user = DB::table('users')->where('id_users',$id_users)->get();
        return view('admin.users.show',['user' => $user]);
    }

    public function edit($id_users)
    {
        $user = DB::table('users')->where('id_users',$id_users)->get();
        return view('admin.users.edit',['user' => $user]);
    }

    public function update(Request $request)
    {
        DB::table('users')->where('id_users',$request->id_users)->update([
			'nama_user' => $request->nama_user,
			'email_user' => $request->email_user,
            'password' => $request->password,
            'update_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('user.index')
                        ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id_users',$id)->delete();

        return redirect()->route('user.index')
                        ->with('success','User deleted successfully');
    }
}
