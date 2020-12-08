<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriPekerjaanController extends Controller
{

    public static function get($filter = NULL) {
		if ($filter == NULL) {
			return KategoriPekerjaan::all();
		}
		return KategoriPekerjaan::where($filter)->get();
	}

    public function create()
    {
        return view('admin.kategori-pekerjaan.create');
    }

    public function store(Request $request)
    {
        $validateData = $this->validate($request, [
			'nama_kategori_pekerjaan' => 'required',
		]);

		$ktgKerja = $request->nama_kategori_pekerjaan;
        $email_user   = $request->email_user;
        $password = $request->password;

		$saveData = KategoriPekerjaan::create([
			'nama_kategori_pekerjaan' => $ktgKerja,
		]);

        return redirect()->route('admin.kategoriPekerjaan')
                        ->with('success','Kategori Pekerjaan created successfully.');
    }

    public function show($id)
    {
        $kategori = KategoriPekerjaan::where('id' , $id)->get();
        return view('admin.kategori-pekerjaan.show',['kategori' => $kategori]);
    }

    public function edit($id)
    {
        $kategori = KategoriPekerjaan::where('id' , $id)->get();
        return view('admin.kategori-pekerjaan.edit',['kategori' => $kategori]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $validateData = $this->validate($request, [
			'nama_kategori_pekerjaan' => 'required',
		]);

		$ktgKerja = $request->nama_kategori_pekerjaan;
        $email_user   = $request->email_user;
        $password = $request->password;

		$saveData = KategoriPekerjaan::where('id', $id)
		->update([
			'nama_kategori_pekerjaan' => $ktgKerja,
		]);

        return redirect()->route('admin.kategoriPekerjaan')
                        ->with('success','Kategori Pekerjaan updated successfully');
    }

    public function delete($id)
    {
        KategoriPekerjaan::where('id' , $id)->delete();
        return redirect()->route('admin.kategoriPekerjaan')
                        ->with('success','Kategori Pekerjaan deleted successfully');
    }
}
