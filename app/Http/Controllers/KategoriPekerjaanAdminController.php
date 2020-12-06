<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPekerjaan;

class KategoriPekerjaanAdminController extends Controller
{

    public function index()
    {
        $kp = KategoriPekerjaan::all();
        return view('admin.kategori-pekerjaan.index',compact('kp'));
    }

    public function create()
    {
        return view('admin.kategori-pekerjaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_pekerjaan' => 'required',
        ]);
 
        KategoriPekerjaan::create($request->all());
 
        return redirect()->route('kategori-pekerjaan.index')
                        ->with('success','Kategori Pekerjaan created successfully.');
    }

    public function show(KategoriPekerjaan $KategoriPekerjaan)
    {
        $kp = $KategoriPekerjaan;
        return view('admin.kategori-pekerjaan.show',compact('kp'));
    }

    public function edit(KategoriPekerjaan $KategoriPekerjaan)
    {
        $kp = $KategoriPekerjaan;
        return view('admin.kategori-pekerjaan.edit',compact('kp'));
    }

    public function update(Request $request, KategoriPekerjaan $KategoriPekerjaan)
    {
        $request->validate([
            'nama_kategori_pekerjaan' => 'required',
        ]);
 
        $KategoriPekerjaan->update($request->all());
 
        return redirect()->route('kategori-pekerjaan.index')
                        ->with('success','Kategori Pekerjaan updated successfully');
    }

    public function destroy(KategoriPekerjaan $KategoriPekerjaan)
    {
        $KategoriPekerjaan->delete();
 
        return redirect()->route('kategori-pekerjaan.index')
                        ->with('success','Kategori Pekerjaan deleted successfully');
    }
}
