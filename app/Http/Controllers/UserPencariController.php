<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\BiodataPekerjaan;
use App\Models\BiodataPelatihan;
use App\Models\BiodataPendidikan;
use App\Models\JenisPendidikan;
use App\Models\KategoriLowongan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\Lamaran;
use App\Models\LokasiLowongan;
use App\Models\LokasiPencari;
use App\Models\Lowongan;
use App\Models\PencariKerja;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserPencariController extends Controller
{
    private function getUserData()
    {
        return Auth::user();
    }

    public function jobIndex()
    {
        $lowongan = DB::table('lowongan')
            ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
            ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
            ->whereRaw('tanggal_ditutup > now()')
            ->take(5)
            ->get();

        return view('index')->with([
            'user' => $this->getUserData(),
            'lowongan' => $lowongan,
        ]);
    }

    public function jobList()
    {
        $lowongan = DB::table('lowongan')
            ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
            ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
            ->whereRaw('tanggal_ditutup > now()')
            ->paginate(10);

        return view('list-job')->with([
            'user' => $this->getUserData(),
            'lowongan' => $lowongan,
        ]);
    }

    public function detailJob($id)
    {
        $loker = DB::table('lowongan')
            ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
            ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
            ->where(['lowongan.id' => $id])
            ->first();

        $kategoriLoker = KategoriLowongan::all()->where('id_lowongan', $loker->id)->take(2);

        $lokasiLoker = LokasiLowongan::all()->where('id_lowongan', $loker->id)->take(2);

        return view('detail-job')->with([
            'user' => $this->getUserData(),
            'loker' => $loker,
            'lokasi' => $lokasiLoker,
            'kategori' => $kategoriLoker
        ]);
    }

    public function jobApply(Request $request)
    {
        $user = $this->getUserData();

        $loker_id = $request->id;
        $biodata = PencariKerja::where('id_user', $user->id)->where('status_pencari', 1)->first();

        $lamaran = Lamaran::where('id_pencari_kerja', $biodata->id)->first();


        if (empty($lamaran)) {
            if (!empty($biodata)) {
                Lamaran::create([
                    'id_lowongan' => $loker_id,
                    'id_pencari_kerja' => $biodata->id,
                    'alasan' => $request->alasan,
                    'status_lamaran' => 0
                ]);
                return view('job-successApply');
            } else {
                return redirect()->route('jobdetail', $loker_id)
                    ->withErrors(["Apply Failed , Biodata Not Found or User not Accepted."]);
            }
        } else {
            return redirect()->route('jobdetail', $loker_id)
                ->withErrors(["Apply Failed , Lamaran Founded."]);
        }
    }


    public function index()
    {
        return view('pencari.index')->with(['data' => $this->getUserData()]);
    }

    public function pencari()
    {

        $pencari = PencariKerja::where('id_user', Auth::user()->id)->first();
        $agama = Agama::where('id', $pencari->agama)->first();
        if ($pencari == NULL) {
            return redirect()->route('pencari.add');
        } else {
            return view('pencari.pencari')->with([
                'data' => $this->getUserData(),
                'pencari' => $pencari,
                'agama' => $agama
            ]);
        }
    }

    public function pencariAdd()
    {
        $jnsPendidikan = JenisPendidikan::all();
        $agama = Agama::all();
        $provinsi = Provinsi::all()->sortBy('name');
        $kota = Kota::all()->sortBy('name');

        return view('pencari.pencariAdd', [
            'jnsPendidikan' => $jnsPendidikan,
            'agama' => $agama,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'data' => $this->getUserData()
        ]);
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

                return redirect()->route('pencari.data')
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

    public function pencariEdit()
    {
        $user = Auth::user();
        $pencari = PencariKerja::where('id_user', $user->id)->first();
        $biodataPend = BiodataPendidikan::all()->where('id_pencari_kerja', $pencari->id);
        $biodataPeker = BiodataPekerjaan::all()->where('id_pencari_kerja', $pencari->id);
        $biodataPel = BiodataPelatihan::all()->where('id_pencari_kerja', $pencari->id);
        $jnsPendidikan = JenisPendidikan::all();
        $agama = Agama::all();
        $provinsi = Provinsi::all()->sortBy('name');
        $kota = Kota::all()->sortBy('name');

        return view('pencari.pencariEdit', [
            'pencari' => $pencari,
            'jnsPendidikan' => $jnsPendidikan,
            'agama' => $agama,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'biodataPend' => $biodataPend,
            'biodataPeker' => $biodataPeker,
            'biodataPel' => $biodataPel,
            'data' => $this->getUserData(),
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
                return redirect()->route('pencari.data')
                    ->with('success', 'Penyedia Kerja updated successfully.');
            } else {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => "Role user tidak diizikan"]);
            }
        } catch (\Throwable $e) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function pencariShow()
    {
        $user = Auth::user();
        $pencari = PencariKerja::where('id_user', $user->id)->first();
        $biodataPend = BiodataPendidikan::all()->where('id_pencari_kerja', $pencari->id);
        $biodataPeker = BiodataPekerjaan::all()->where('id_pencari_kerja', $pencari->id);
        $biodataPel = BiodataPelatihan::all()->where('id_pencari_kerja', $pencari->id);
        $jnsPendidikan = JenisPendidikan::all();
        $agama = Agama::all();
        $provinsi = Provinsi::all()->sortBy('name');
        $kota = Kota::all()->sortBy('name');

        return view('pencari.pencariShow', [
            'pencari' => $pencari,
            'jnsPendidikan' => $jnsPendidikan,
            'agama' => $agama,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'biodataPend' => $biodataPend,
            'biodataPeker' => $biodataPeker,
            'biodataPel' => $biodataPel,
            'data' => $this->getUserData(),
        ]);
    }

    public function lamaran()
    {
      $user = $this->getUserData();
      $pencari = PencariKerja::where('id_user', $user->id)->first();
      $lamaran = Lamaran::all()->where('id_pencari_kerja', $pencari->id);
      if(!empty($pencari)) {
        if ($pencari->status_pencari == 0) {
            return redirect()->route('pencari.data')->with(['error' => 'Biodata anda belum disetujui!']);
          }else {
            return view('pencari.lamaran.index')->with(['data' => $this->getUserData(), 'lamaran' => $lamaran, 'pencari' => $pencari]);
          }
      } else {
        return redirect()->route('pencari.data')->with(['error' => 'Isi Data pencari Terlebih dahulu!']);
      }

    }

    public function lamaranDelete($id)
    {
        $lamaran = Lamaran::where('id', $id)->delete();

        return redirect()->route('pencari.lowongan')
            ->with('success', 'Lamaran deleted successfully');
    }
}
