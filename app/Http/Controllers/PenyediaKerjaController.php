<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kontak;
use App\Models\Kota;
use Illuminate\Http\Request;
use App\Models\PenyediaKerja;
use App\Models\Provinsi;
use Illuminate\Support\Facades\DB;

class PenyediaKerjaController extends Controller
{

    public static function get($filter = NULL) {
		if ($filter == NULL) {
			return PenyediaKerja::all();
		}
		return PenyediaKerja::where($filter)->get();
	}

    public function create()
    {
        $provinsi = Provinsi::orderBy('name')->pluck('name', 'id');
        $ktgPekerjaan = KategoriPekerjaan::orderBy('nama_kategori_pekerjaan')->pluck('nama_kategori_pekerjaan', 'id');
        return view('admin.penyedia-kerja.create', ['provinsi' => $provinsi , 'ktgPekerjaan' => $ktgPekerjaan]);
    }

    public function getKota($id)
    {
        $kota = Kota::where('province_id', $id)
            ->orderBy('name')
            ->pluck('name', 'id');

        return response()->json($kota);

    }

    public function getKecamatan($id)
    {
        $kecamatan = Kecamatan::where('city_id', $id)
            ->orderBy('name')
            ->pluck('name', 'id');

        return response()->json($kecamatan);

    }

    public function getKelurahan($id)
    {
        $kelurahan = Kelurahan::where('district_id', $id)
            ->orderBy('name')
            ->pluck('name', 'id');

        return response()->json($kelurahan);

    }

    public function store(Request $request)
    {
        $logo = $request->file('logo_perusahaan');
        $logoFileName = $logo->getClientOriginalName();

        $validateData = $this->validate($request, [
            'nama_perusahaan' => 'required',
            'bidang_usaha' => 'required',
            'alamat_web' => 'required',
            'alamat_perusahaan' => 'required',
            'deskripsi_perusahaan' => 'required',
            'logo_perusahaan' => 'required|mimes:jpg,png|max:2048',
            'id_kontak'  => 'required',

            'no_hp'  => 'required',
            'email'  => 'required',
		]);

        $kontak = Kontak::create([
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'link_ig' => $request->link_ig,
            'link_twitter' => $request->link_twitter,
            'link_linkedin' => $request->link_linkedin,
            'link_facebook' => $request->link_facebook,
            'jenis_kontak' => $request->jenis_kontak
        ]);

        $pk = PenyediaKerja::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'bidang_usaha' => $request->bidang_usaha,
            'alamat_web' => $request->alamat_web,
            'id_kontak' => $kontak->id_kontak,
            'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
            'logo_perusahaan' => $logoFileName,
        ]);

        $logo->storeAs('public/logo_perusahaan', $logoFileName);

        return redirect()->route('admin.penyediaKerja')
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
