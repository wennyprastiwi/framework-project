<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriPekerjaanAdminController extends Controller
{

    public function index()
    {
        $kategori = DB::table('kategori_pekerjaan')->get();
        return view('admin.kategori-pekerjaan.index',compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori-pekerjaan.create');
    }

    public function store(Request $request)
    {
        DB::table('kategori_pekerjaan')->insert([
			'nama_kategori_pekerjaan' => $request->nama_kategori_pekerjaan,
            'created_at' => date('Y-m-d H:i:s'),
		]);

        return redirect()->route('kategori-pekerjaan.index')
                        ->with('success','Kategori Pekerjaan created successfully.');
    }

    public function show($id)
    {
        $kategori = DB::table('kategori_pekerjaan')->where('id_kategori_pekerjaan',$id)->get();
        return view('admin.kategori-pekerjaan.show',['kategori' => $kategori]);
    }

    public function edit($id)
    {
        $kategori = DB::table('kategori_pekerjaan')->where('id_kategori_pekerjaan',$id)->get();
        return view('admin.kategori-pekerjaan.edit',['kategori' => $kategori]);
    }

    public function update(Request $request)
    {
        DB::table('kategori_pekerjaan')->where('id_kategori_pekerjaan',$request->id_kategori_pekerjaan)->update([
			'nama_kategori_pekerjaan' => $request->nama_kategori_pekerjaan,
            'update_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('kategori-pekerjaan.index')
                        ->with('success','Kategori Pekerjaan updated successfully');
    }

    public function destroy($id)
    {
        DB::table('kategori_pekerjaan')->where('id_kategori_pekerjaan',$id)->delete();

        return redirect()->route('kategori-pekerjaan.index')
                        ->with('success','Kategori Pekerjaan deleted successfully');
    }
}
