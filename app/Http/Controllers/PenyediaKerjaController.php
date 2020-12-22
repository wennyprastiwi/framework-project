<?php

namespace App\Http\Controllers;

use App\Models\BidangPerusahaan;
use App\Models\DokumenPerusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kontak;
use App\Models\Kota;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Models\PenyediaKerja;
use App\Models\Provinsi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $provinsi = Provinsi::all();
        $ktgPekerjaan = KategoriPekerjaan::orderBy('nama_kategori_pekerjaan')->pluck('nama_kategori_pekerjaan', 'id');
        return view('admin.penyedia-kerja.create', ['provinsi' => $provinsi , 'ktgPekerjaan' => $ktgPekerjaan]);
    }

    public function getKota(Request $request)
    {
        $id = $request->provinsi_id;
        $kota = Kota::where('province_id', $id)
            ->orderBy('name')
            ->pluck('name', 'id');

        return response()->json($kota);

    }

    public function getKecamatan(Request $request)
    {
        $id = $request->kota_id;
        $kecamatan = Kecamatan::where('city_id', $id)
            ->orderBy('name')
            ->pluck('name', 'id');

        return response()->json($kecamatan);

    }

    public function getKelurahan(Request $request)
    {
        $id = $request->kecamatan_id;
        $kelurahan = Kelurahan::where('district_id', $id)
            ->orderBy('name')
            ->pluck('name', 'id');

        return response()->json($kelurahan);

    }

    public function store(Request $request)
    {
        DB::beginTransaction();


        $logo = $request->file('logo_perusahaan');
        $npwp = $request->file('npwp');
        $sop  = $request->file('sop');
        $surat= $request->file('surat_domisili');

        $logoFileName = $logo->getClientOriginalName();
        $npwpFileName = $npwp->getClientOriginalName();
        $sopFileName = $sop->getClientOriginalName();
        $suratFileName = $surat->getClientOriginalName();


        $validateData = $this->validate($request, [
            'nama_perusahaan' => 'required',
            'alamat_web' => 'required',
            'alamat_perusahaan' => 'required',
            'deskripsi_perusahaan' => 'required',
            'logo_perusahaan' => 'required|max:4096',
            'npwp' =>  'required|max:4096',
            'sop' => 'required|max:4096',
            'surat_domisili' => 'required|max:4096',

            'no_hp'  => 'required',
            'email'  => 'required',
		]);

        try {

            $pk = PenyediaKerja::create([
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_web' => $request->alamat_web,
                'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
                'logo_perusahaan' => $logoFileName,
                'status_perusahaan' => 0
            ]);

            $kontak = Kontak::create([
                'id_penyedia_kerja' =>  $pk->id,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'jenis_kontak' => 2
            ]);

            $dokumen = DokumenPerusahaan::create([
                'id_penyedia_kerja' =>  $pk->id,
                'sop' => $sopFileName,
                'surat_domisili' => $suratFileName,
                'npwp' => $npwpFileName
            ]);

            $lokasi = Lokasi::create([
                'nama_lokasi' => $request->alamat_perusahaan,
                'id_provinsi' => $request->indonesia_provinces,
                'id_kota' => $request->indonesia_cities,
                'id_kecamatan' => $request->indonesia_districts,
                'id_kelurahan' => $request->indonesia_villages,
                'id_penyedia_kerja' =>  $pk->id
            ]);

            $finalArray = array();
            foreach($request->bidang_usaha as $value){
                array_push($finalArray, array(
                        'id_kategori_pekerjaan' =>  $value,
                        'id_penyedia_kerja' =>  $pk->id,
                        'created_at' => date('Y-m-d H:i:s')
                    )
                );
            };

            BidangPerusahaan::insert($finalArray);

            $logo->storeAs('public/logo_perusahaan', $logoFileName);
            $npwp->storeAs('public/npwp', $npwpFileName);
            $sop->storeAs('public/sop', $sopFileName);
            $surat->storeAs('public/surat', $suratFileName);

            DB::commit();

            return redirect()->route('admin.penyediaKerja')
                            ->with('success','Penyedia Kerja created successfully.');

        } catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $penyediaKerja = PenyediaKerja::where('id' , $id)->first();
        // dd($penyediaKerja->bidang);
        return view('admin.penyedia-kerja.show',['penyediaKerja' => $penyediaKerja]);
    }

    public function edit($id)
    {
        $penyediaKerja = PenyediaKerja::where('id' , $id)->first();
        $bidangKerja = BidangPerusahaan::all()->where('id_penyedia_kerja', $penyediaKerja->id);
        $provinsi = Provinsi::all();
        $ktgPekerjaan = KategoriPekerjaan::all();

        return view('admin.penyedia-kerja.edit',[
            'penyediaKerja' => $penyediaKerja ,
            'provinsi' => $provinsi,
            'ktgPekerjaan' => $ktgPekerjaan,
            'bidKerja' => $bidangKerja
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $id = $request->id;

        $logo = $request->file('logo_perusahaan');
        $npwp = $request->file('npwp');
        $sop  = $request->file('sop');
        $surat= $request->file('surat_domisili');

        $validateData = $this->validate($request, [
            'nama_perusahaan' => 'required',
            'alamat_web' => 'required',
            'alamat_perusahaan' => 'required',
            'deskripsi_perusahaan' => 'required',
            'logo_perusahaan' => 'required|max:4096',
            'npwp' =>  'required|max:4096',
            'sop' => 'required|max:4096',
            'surat_domisili' => 'required|max:4096',

            'no_hp'  => 'required',
            'email'  => 'required',
		]);

        try {

            $pk = PenyediaKerja::where('id', $id);
            $updatePk = [
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_web' => $request->alamat_web,
                'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
                'status_perusahaan' => 0
            ];

            if ($logo) {
                $logoFileName = $logo->getClientOriginalName();
                $deleteOldPhoto = Storage::delete('public/logo_perusahaan/'.$pk->first()->logo_perusahaan);
                $uploadNewPhoto =  $logo->storeAs('public/logo_perusahaan', $logoFileName);
                $updatePk['logo_perusahaan'] = $logoFileName;
            }

            $pk->update($updatePk);

            $kontak = Kontak::where('id_penyedia_kerja', $pk->first()->id)
                ->update([
                    'no_hp' => $request->no_hp,
                    'email' => $request->email,
                    'jenis_kontak' => 2
            ]);

            $dokumen = DokumenPerusahaan::where('id_penyedia_kerja', $pk->first()->id);
               $updateDok = [];
               if ($npwp || $sop || $surat) {
                    $npwpFileName = $npwp->getClientOriginalName();
                    $sopFileName = $sop->getClientOriginalName();
                    $suratFileName = $surat->getClientOriginalName();

                    $deleteOldNpwp = Storage::delete('public/npwp/'.$dokumen->first()->npwp);
                    $uploadNewNpwp =  $logo->storeAs('public/npwp', $npwpFileName);

                    $deleteOldSop = Storage::delete('public/sop/'.$dokumen->first()->sop);
                    $uploadNewSop =  $logo->storeAs('public/sop', $sopFileName);

                    $deleteOldSurat = Storage::delete('public/surat/'.$dokumen->first()->surat_domisili);
                    $uploadNewSurat =  $logo->storeAs('public/surat', $suratFileName);

                    $updateDok['npwp'] = $npwpFileName;
                    $updateDok['sop'] = $sopFileName;
                    $updateDok['surat_domisili'] = $suratFileName;
               }

            $dokumen->update($updateDok);

            $lokasi = Lokasi::where('id_penyedia_kerja', $pk->first()->id)
                ->update([
                    'nama_lokasi' => $request->alamat_perusahaan,
                    'id_provinsi' => $request->indonesia_provinces,
                    'id_kota' => $request->indonesia_cities,
                    'id_kecamatan' => $request->indonesia_districts,
                    'id_kelurahan' => $request->indonesia_villages,
            ]);

            $bidangPerusahaan = BidangPerusahaan::where('id_penyedia_kerja', $pk->first()->id);
            $updateBid =
                $finalArray = array();
                foreach($request->bidang_usaha as $value){
                    array_push($finalArray, array(
                            'id_kategori_pekerjaan' =>  $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        )
                    );
                };

            $bidangPerusahaan->update($updateBid);

            DB::commit();

            return redirect()->route('admin.penyediaKerja')
                            ->with('success','Penyedia Kerja updated successfully.');

        } catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function accepted($id)
    {
        $penyediaKerja = PenyediaKerja::findOrFail($id);
        $penyediaKerja->status_perusahaan = 1;
        $penyediaKerja->save();

        return redirect()->route('admin.penyediaKerja')
                        ->with('success','Penyedia Kerja accepted successfully.');
    }

    public function decline ($id)
    {
        $penyediaKerja = PenyediaKerja::findOrFail($id);
        $penyediaKerja->status_perusahaan = 2;
        $penyediaKerja->save();

        return redirect()->route('admin.penyediaKerja')
                        ->with('success','Penyedia Kerja decline  successfully.');
    }

    public function delete($id)
    {
        $penyediaKerja = PenyediaKerja::where('id' , $id)->first();

        $hapusLogo = Storage::delete('public/logo_perusahaan/'.$penyediaKerja['logo_perusahaan']);
        $hapusNpwp = Storage::delete('public/npwp/'.$penyediaKerja->dokumen['npwp']);
        $hapusSop = Storage::delete('public/sop/'.$penyediaKerja->dokumen['sop']);
        $hapusSurat = Storage::delete('public/surat/'.$penyediaKerja->dokumen['surat_domisili']);

        $penyediaKerja->delete($hapusLogo,$hapusNpwp,$hapusSop,$hapusSurat);

        return redirect()->route('admin.penyediaKerja')
                        ->with('success','Penyedia Kerja deleted successfully');
    }
}
