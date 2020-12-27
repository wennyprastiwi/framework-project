<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function getAdminData()
    {
      return Auth::user();
    }

    private function getType()
    {
      return Type::all();
    }

    public static function get($filter = NULL) {
		if ($filter == NULL) {
			return User::all();
		}
		return User::where($filter)->get();
	}

    public function create()
    {
        return view('admin.users.create')->with(['admin' => $this->getAdminData(), 'type' => $this->getType()]);
    }

    public function store(Request $request)
    {
        $validateData = $this->validate($request, [
			'nama_user' => 'required',
            'email_user' => 'required',
            'password' => 'required',
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

        return redirect()->route('admin.user')
                        ->with('success','User created successfully.');
    }

    public function show($id)
    {
        $user = User::where('id' , $id)->get();
        return view('admin.users.show',['user' => $user],['admin' => $this->getAdminData()]);
    }

    public function edit($id)
    {
        $user = User::where('id' , $id)->get();
        return view('admin.users.edit')->with(['user' => $user, 'admin' => $this->getAdminData(), 'type' => $this->getType()]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

		$validateData = $this->validate($request, [
			'nama_user' => 'required',
            'email_user' => 'required',
            'type' => 'required',
		]);

		$nama_user = $request->nama_user;
        $email_user = $request->email_user;
        $password = $request->password;
        $type = $request->type;

		$saveData = User::where('id', $id)
		->update([
			'nama_user' => $nama_user,
            'email_user' => $email_user,
            'type' => $type,
            
        ]);
        if($password != NULL){
            $saveData = User::where('id', $id)
            ->update(['password' => Hash::make($password),]);
        }

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
