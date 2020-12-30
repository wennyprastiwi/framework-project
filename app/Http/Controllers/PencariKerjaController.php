<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\BiodataPekerjaan;
use App\Models\BiodataPelatihan;
use App\Models\BiodataPendidikan;
use App\Models\JenisPendidikan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\LokasiPencari;
use App\Models\PencariKerja;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PencariKerjaController extends Controller
{

    private function getAdminData()
    {
        return $admin = Auth::user();
    }

    public static function get($filter = NULL)
    {
        if ($filter == NULL) {
            return PencariKerja::all();
        }
        return PencariKerja::where($filter)->get();
    }

    public function create()
    {
        $jnsPendidikan = JenisPendidikan::all();
        $agama = Agama::all();
        $provinsi = Provinsi::all()->sortBy('name');
        $kota = Kota::all()->sortBy('name');

        return view('admin.pencari-kerja.create', [
            'jnsPendidikan' => $jnsPendidikan,
            'agama' => $agama,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'admin' => $this->getAdminData()
        ]);
    }

    public function getKota(Request $request)
    {
        $id = $request->provinsi_id;
        $kota = Kota::where('province_id', $id)
            ->pluck('name', 'id')
            ->sortBy('name');
        return response()->json($kota);
    }

    public function getKecamatan(Request $request)
    {
        $id = $request->kota_id;
        $kecamatan = Kecamatan::where('city_id', $id)
            ->pluck('name', 'id')
            ->sortBy('name');
        return response()->json($kecamatan);
    }

    public function getKelurahan(Request $request)
    {
        $id = $request->kecamatan_id;
        $kelurahan = Kelurahan::where('district_id', $id)
            ->pluck('name', 'id')
            ->sortBy('name');
        return response()->json($kelurahan);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            if ($user->type == 99 || 1) {
                $file_vc = $request->file('file_cv');

                $cvFileName = $file_vc->getClientOriginalName();

                $validateData = $this->validate($request, [
                    'nama_lengkap' => 'required',
                    'nik' => 'required',
                    'jenis_kelamin' => 'required',
                    'agama' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'status_pernikahan' =>  'required',
                    'file_cv' => 'required|max:4096',
                ]);

                $pnk = PencariKerja::create([
                    'id_user' => $user->id,
                    'nama_lengkap' => $request->nama_lengkap,
                    'nik' => $request->nik,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'status_pernikahan' => $request->status_pernikahan,
                    'file_cv' => $cvFileName,
                    'status_pencari' => 0
                ]);

                $pnk_id = $pnk->id;

                $lokasi = LokasiPencari::create([
                    'nama_lokasi' => $request->alamat_pencari,
                    'id_provinsi' => $request->indonesia_provinces,
                    'id_kota' => $request->indonesia_cities,
                    'id_kecamatan' => $request->indonesia_districts,
                    'id_kelurahan' => $request->indonesia_villages,
                    'id_pencari_kerja' => $pnk_id
                ]);

                for ($count = 0; $count < count($request->nama_pekerjaan); $count++) {
                    if ($request->nama_pekerjaan[$count] != null && $request->lokasi_kerja[$count] != null && $request->tanggal_masuk[$count] && $request->tanggal_keluar[$count]) {
                        $dataPeker = array(
                            'nama_pekerjaan' => $request->nama_pekerjaan[$count],
                            'lokasi_kerja' => $request->lokasi_kerja[$count],
                            'tanggal_masuk' => $request->tanggal_masuk[$count],
                            'tanggal_keluar' => $request->tanggal_keluar[$count],
                            'id_pencari_kerja' => $pnk_id
                        );
                        BiodataPekerjaan::create($dataPeker);
                    }
                }

                for ($count = 0; $count < count($request->nama_instansi); $count++) {
                    if ($request->nama_instansi[$count] != null && $request->tingkat_pendidikan[$count] != null && $request->tahun_masuk[$count] && $request->tahun_lulus[$count]) {
                        $dataPend = array(
                            'nama_instansi' => $request->nama_instansi[$count],
                            'pendidikan_terakhir' => $request->tingkat_pendidikan[$count],
                            'tahun_masuk' => $request->tahun_masuk[$count],
                            'tahun_lulus' => $request->tahun_lulus[$count],
                            'id_pencari_kerja' => $pnk_id
                        );

                        BiodataPendidikan::create($dataPend);
                    }
                }

                for ($count = 0; $count < count($request->nama_pelatihan); $count++) {
                    if ($request->nama_pelatihan[$count] != null && $request->tahun_pelatihan[$count] != null && $request->deskripsi_pelatihan[$count]) {
                        $dataPel = array(
                            'nama_pelatihan' => $request->nama_pelatihan[$count],
                            'tahun_pelatihan' => $request->tahun_pelatihan[$count],
                            'deskripsi_singkat' => $request->deskripsi_pelatihan[$count],
                            'id_pencari_kerja' => $pnk_id
                        );

                        BiodataPelatihan::create($dataPel);
                    }
                }

                $file_vc->storeAs('public/cv_pencari', $cvFileName);

                DB::commit();

                return redirect()->route('admin.pencariKerja')
                    ->with('success', 'Penyedia Kerja created successfully.');
            } else {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => "Role user tidak diizikan"]);
            }
        } catch (\Throwable $e) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $pencariKerja = PencariKerja::where('id', $id)->first();
        $biodataPend = BiodataPendidikan::all()->where('id_pencari_kerja', $pencariKerja->id);
        $biodataPeker = BiodataPekerjaan::all()->where('id_pencari_kerja', $pencariKerja->id);
        $biodataPel = BiodataPelatihan::all()->where('id_pencari_kerja', $pencariKerja->id);
        $jnsPendidikan = JenisPendidikan::all();
        $agama = Agama::all();
        $provinsi = Provinsi::all()->sortBy('name');
        $kota = Kota::all()->sortBy('name');
        // dd($pencariKerja->bidang);
        return view('admin.pencari-kerja.show', [
            'pencariKerja' => $pencariKerja,
            'jnsPendidikan' => $jnsPendidikan,
            'agama' => $agama,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'biodataPend' => $biodataPend,
            'biodataPeker' => $biodataPeker,
            'biodataPel' => $biodataPel
        ]);
    }

    public function edit($id)
    {
        $pencariKerja = PencariKerja::where('id', $id)->first();
        $biodataPend = BiodataPendidikan::all()->where('id_pencari_kerja', $pencariKerja->id);
        $biodataPeker = BiodataPekerjaan::all()->where('id_pencari_kerja', $pencariKerja->id);
        $biodataPel = BiodataPelatihan::all()->where('id_pencari_kerja', $pencariKerja->id);
        $jnsPendidikan = JenisPendidikan::all();
        $agama = Agama::all();
        $provinsi = Provinsi::all()->sortBy('name');
        $kota = Kota::all()->sortBy('name');

        return view('admin.pencari-kerja.edit', [
            'pencariKerja' => $pencariKerja,
            'jnsPendidikan' => $jnsPendidikan,
            'agama' => $agama,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'biodataPend' => $biodataPend,
            'biodataPeker' => $biodataPeker,
            'biodataPel' => $biodataPel
        ]);
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();

            if ($user->type == 99 || $user->type == 1) {

                $id = $request->id;

                $file_vc = $request->file('file_cv');

                $validateData = $this->validate($request, [
                    'nama_lengkap' => 'required',
                    'nik' => 'required',
                    'jenis_kelamin' => 'required',
                    'agama' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'status_pernikahan' =>  'required',
                    'file_cv' => 'max:4096',
                ]);

                $pnk = PencariKerja::where('id', $id)->first();

                $updatePnk = [
                    'id_user' => $user->id,
                    'nama_lengkap' => $request->nama_lengkap,
                    'nik' => $request->nik,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'status_pernikahan' => $request->status_pernikahan,
                    'status_pencari' => 0
                ];

                if ($file_vc) {
                    $cvFileName = $file_vc->getClientOriginalName();
                    $deleteOldPhoto = Storage::delete('public/cv_pencari/' . $pnk->file_cv);
                    $uploadNewPhoto =  $file_vc->storeAs('public/cv_pencari', $cvFileName);
                    $updatePnk['file_cv'] = $cvFileName;
                }

                $pnk->update($updatePnk);

                $pnk_id = $pnk->id;

                $lokasi = LokasiPencari::where('id_pencari_kerja', $pnk_id)
                    ->update([
                        'nama_lokasi' => $request->alamat_pencari,
                        'id_provinsi' => $request->indonesia_provinces,
                        'id_kota' => $request->indonesia_cities,
                        'id_kecamatan' => $request->indonesia_districts,
                        'id_kelurahan' => $request->indonesia_villages,
                        'id_pencari_kerja' => $pnk_id
                    ]);

                $bioPeker = BiodataPekerjaan::where('id_pencari_kerja', $pnk_id);
                $bioPeker->delete();

                for ($count = 0; $count < count($request->nama_pekerjaan); $count++) {
                    if ($request->nama_pekerjaan[$count] != null && $request->lokasi_kerja[$count] != null && $request->tanggal_masuk[$count] && $request->tanggal_keluar[$count]) {
                        $dataPeker = array(
                            'nama_pekerjaan' => $request->nama_pekerjaan[$count],
                            'lokasi_kerja' => $request->lokasi_kerja[$count],
                            'tanggal_masuk' => $request->tanggal_masuk[$count],
                            'tanggal_keluar' => $request->tanggal_keluar[$count],
                            'id_pencari_kerja' => $pnk_id
                        );
                        BiodataPekerjaan::create($dataPeker);
                    }
                }

                $bioPend = BiodataPendidikan::where('id_pencari_kerja', $pnk_id);
                $bioPend->delete();

                for ($count = 0; $count < count($request->nama_instansi); $count++) {
                    if ($request->nama_instansi[$count] != null && $request->tingkat_pendidikan[$count] != null && $request->tahun_masuk[$count] && $request->tahun_lulus[$count]) {
                        $dataPend = array(
                            'nama_instansi' => $request->nama_instansi[$count],
                            'pendidikan_terakhir' => $request->tingkat_pendidikan[$count],
                            'tahun_masuk' => $request->tahun_masuk[$count],
                            'tahun_lulus' => $request->tahun_lulus[$count],
                            'id_pencari_kerja' => $pnk_id
                        );

                        BiodataPendidikan::create($dataPend);
                    }
                }


                $bioPel = BiodataPelatihan::where('id_pencari_kerja', $pnk_id);

                $bioPel->delete();

                for ($count = 0; $count < count($request->nama_pelatihan); $count++) {
                    if ($request->nama_pelatihan[$count] != null && $request->tahun_pelatihan[$count] != null && $request->deskripsi_pelatihan[$count]) {
                        $dataPel = array(
                            'nama_pelatihan' => $request->nama_pelatihan[$count],
                            'tahun_pelatihan' => $request->tahun_pelatihan[$count],
                            'deskripsi_singkat' => $request->deskripsi_pelatihan[$count],
                            'id_pencari_kerja' => $pnk_id
                        );

                        BiodataPelatihan::create($dataPel);
                    }
                }

                DB::commit();
                return redirect()->route('admin.pencariKerja')
                    ->with('success', 'Penyedia Kerja created successfully.');
            } else {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => "Role user tidak diizikan"]);
            }
        } catch (\Throwable $e) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function accepted($id)
    {
        $pencariKerja = PencariKerja::findOrFail($id);
        $pencariKerja->status_pencari = 1;
        $pencariKerja->save();

        return redirect()->route('admin.pencariKerja')
            ->with('success', 'Pencari Kerja accepted successfully.');
    }

    public function decline($id)
    {
        $pencariKerja = PencariKerja::findOrFail($id);
        $pencariKerja->status_pencari = 2;
        $pencariKerja->save();

        $pencariKerja = PencariKerja::where('id', $id)->delete();

        return redirect()->route('admin.pencariKerja')
            ->with('success', 'Pencari Kerja decline successfully.');
    }

    public function delete($id)
    {
        $pencariKerja = PencariKerja::where('id', $id)->first();

        $hapusCv = Storage::delete('public/cv_pencari/' . $pencariKerja->file_cv);

        $pencariKerja->delete($hapusCv);

        return redirect()->route('admin.pencariKerja')
            ->with('success', 'Pencari Kerja deleted successfully');
    }
}
