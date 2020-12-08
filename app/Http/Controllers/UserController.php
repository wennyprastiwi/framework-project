<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public static function get($filter = NULL) {
		if ($filter == NULL) {
			return User::all();
		}
		return User::where($filter)->get();
	}

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validateData = $this->validate($request, [
			'nama_user' => 'required',
            'email_user' => 'required',
            'password' => 'required',
		]);

		$nama_user = $request->nama_user;
        $email_user   = $request->email_user;
        $password = $request->password;

		$saveData = User::create([
			'nama_user' => $nama_user,
            'email_user' => $email_user,
            'password' => $password,
		]);

        return redirect()->route('admin.user')
                        ->with('success','User created successfully.');
    }

    public function show($id)
    {
        $user = User::where('id' , $id)->get();
        return view('admin.users.show',['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::where('id' , $id)->get();
        return view('admin.users.edit',['user' => $user]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

		$validateData = $this->validate($request, [
			'nama_user' => 'required',
            'email_user' => 'required',
            'password' => 'required',
		]);

		$nama_user = $request->nama_user;
        $email_user   = $request->email_user;
        $password = $request->password;

		$saveData = User::where('id', $id)
		->update([
			'nama_user' => $nama_user,
            'email_user' => $email_user,
            'password' => $password,
		]);

        return redirect()->route('admin.user')
                        ->with('success','User updated successfully');
    }

    public function delete($id)
    {
        User::where('id' , $id)->delete();
        return redirect()->route('admin.user')
                        ->with('success','User deleted successfully');
    }
}
