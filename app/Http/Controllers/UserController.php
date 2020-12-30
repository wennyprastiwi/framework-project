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
			return User::all()->where('type' , '!=' , 99);
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
            'username' => 'required|unique:users',
            'email_user' => 'required|email|unique:users',
            'password' => 'required',
            'type' => 'required',
		]);

        $nama_user = $request->nama_user;
        $username = $request->username;
        $email_user = $request->email_user;
        $password = $request->password;
        $type = $request->type;

		$saveData = User::create([
            'nama_user' => $nama_user,
            'username' => $username,
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
            'username' => 'unique:users',
            'email_user' => 'unique:users',
            'type' => 'required',
		]);

        $nama_user = $request->nama_user;
        $username = $request->username;
        $email_user = $request->email_user;
        $password = $request->password;
        $type = $request->type;

		$saveData = User::where('id', $id)
		->update([
            'nama_user' => $nama_user,
            'type' => $type,
        ]);
        if($username != NULL){
            $saveData = User::where('id', $id)
            ->update(['username' => $username]);
        }
        if($email_user != NULL){
            $saveData = User::where('id', $id)
            ->update(['email_user' => $email_user]);
        }
        if($password != NULL){
            $saveData = User::where('id', $id)
            ->update(['password' => Hash::make($password)]);
        }

        return redirect()->route('admin.user')
                        ->with('success','User updated successfully');
    }

    public function accepted($id)
    {
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect()->route('admin.user')
            ->with('success', 'User accepted successfully.');
    }

    public function decline($id)
    {
        $user = User::findOrFail($id);
        $user->status = 2;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        User::where('id' , $id)->delete();

        return redirect()->route('admin.user')
            ->with('success', 'User decline successfully.');
    }

    public function delete($id)
    {
        User::where('id' , $id)->delete();
        return redirect()->route('admin.user')
                        ->with('success','User deleted successfully');
    }
}
