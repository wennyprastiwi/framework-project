<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyediaKerja;

class PenyediaKerjaAdminController extends Controller
{

    public function index()
    {
        $pk = PenyediaKerja::all();
        return view('admin.penyedia-kerja.index',compact('pk'));
    }

    public function create()
    {
        return view('admin.penyedia-kerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required', 
            'bidang_usaha' => 'required', 
            'alamat_web' => 'required', 
            'deskripsi_perusahaan' => 'required', 
        ]);
 
        PenyediaKerja::create($request->all());
 
        return redirect()->route('penyedia-kerja.index')
                        ->with('success','Penyedia Kerja created successfully.');
    }

    public function show(PenyediaKerja $PenyediaKerja)
    {
        $pk = $PenyediaKerja;
        return view('admin.penyedia-kerja.show',compact('pk'));
    }

    public function edit(PenyediaKerja $PenyediaKerja)
    {
        $pk = $PenyediaKerja;
        return view('admin.penyedia-kerja.edit',compact('pk'));
    }

    public function update(Request $request, PenyediaKerja $PenyediaKerja)
    {
        $request->validate([
            'nama_perusahaan' => 'required', 
            'bidang_usaha' => 'required', 
            'alamat_web' => 'required', 
            'deskripsi_perusahaan' => 'required', 
        ]);
 
        $PenyediaKerja->update($request->all());
 
        return redirect()->route('penyedia-kerja.index')
                        ->with('success','Penyedia Kerja updated successfully');
    }

    public function destroy(PenyediaKerja $PenyediaKerja)
    {
        $PenyediaKerja->delete();
 
        return redirect()->route('penyedia-kerja.index')
                        ->with('success','Penyedia Kerja deleted successfully');
    }
}
