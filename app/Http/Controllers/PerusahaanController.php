<?php

namespace App\Http\Controllers;

use App\Models\PenyediaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BidangPerusahaan;
use App\Models\DokumenPerusahaan;
use App\Models\KategoriLowongan;
use App\Models\KategoriPekerjaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kontak;
use App\Models\Kota;
use App\Models\Lokasi;
use App\Models\LokasiLowongan;
use App\Models\Lowongan;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PerusahaanBaru;

class PerusahaanController extends Controller
{
    private function getUserData()
    {
      return Auth::user();
    }

    public function index()
    {
      return view('perusahaan.index')->with(['data' => $this->getUserData()]);
    }

    public function perusahaan()
    {

      $perusahaan = PenyediaKerja::where('id_user' , Auth::user()->id)->first();
      if ($perusahaan == NULL) {
        return redirect()->route('perusahaan.add');
      }else {
          return view('perusahaan.perusahaan')->with([
              'data' => $this->getUserData(),
              'perusahaan' => $perusahaan,
        ]);
      }
    }

    public function perusahaanAdd()
    {
      $provinsi = Provinsi::all();
      $ktgPekerjaan = KategoriPekerjaan::orderBy('nama_kategori_pekerjaan')->pluck('nama_kategori_pekerjaan', 'id');

      return view('perusahaan.perusahaanAdd')->with([
        'data' => $this->getUserData(),
        'provinsi' => $provinsi,
        'ktgPekerjaan' => $ktgPekerjaan,
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

            if ($user->type == 99 || $user->type == 2) {

                $logo = $request->file('logo_perusahaan');
                $npwp = $request->file('npwp');
                $sop  = $request->file('sop');
                $surat = $request->file('surat_domisili');

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


                $pk = PenyediaKerja::create([
                    'id_user' => $user->id,
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
                foreach ($request->bidang_usaha as $value) {
                    array_push($finalArray, array(
                        'id_kategori_pekerjaan' =>  $value,
                        'id_penyedia_kerja' =>  $pk->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ));
                };

                BidangPerusahaan::insert($finalArray);

                $logo->storeAs('public/logo_perusahaan', $logoFileName);
                $npwp->storeAs('public/npwp', $npwpFileName);
                $sop->storeAs('public/sop', $sopFileName);
                $surat->storeAs('public/surat', $suratFileName);

                DB::commit();
                //notif perusahaanbaru
                $author = User::where('id', $pk->id_user)->first();
                $users = User::all()->where('type',99);
                foreach ($users as $user) {
                    $user->notify(new PerusahaanBaru($pk,$author));
                }

                return redirect()->route('perusahaan.data')
                    ->with('success', 'Data Perusahaan created successfully.');
            } else {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => "Role user tidak diizikan"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function perusahaanEdit()
    {
        $user = Auth::user();
        $perusahaan = PenyediaKerja::where('id_user', $user->id)->first();
        $bidangKerja = BidangPerusahaan::all()->where('id_penyedia_kerja', $perusahaan->id);
        $provinsi = Provinsi::all();
        $ktgPekerjaan = KategoriPekerjaan::all();

        return view('perusahaan.perusahaanEdit', [
            'perusahaan' => $perusahaan,
            'provinsi' => $provinsi,
            'ktgPekerjaan' => $ktgPekerjaan,
            'bidKerja' => $bidangKerja,
            'data' => $this->getUserData(),
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $id = $request->id;

        $logo = $request->file('logo_perusahaan');
        $npwp = $request->file('npwp');
        $sop  = $request->file('sop');
        $surat = $request->file('surat_domisili');

        $validateData = $this->validate($request, [
            'nama_perusahaan' => 'required',
            'alamat_web' => 'required',
            'alamat_perusahaan' => 'required',
            'deskripsi_perusahaan' => 'required',
            'logo_perusahaan' => 'max:4096',
            'npwp' =>  'max:4096',
            'sop' => 'max:4096',
            'surat_domisili' => 'max:4096',

            'no_hp'  => 'required',
            'email'  => 'required',
        ]);

        try {

            $pk = PenyediaKerja::where('id', $id)->first();
            $updatePk = [
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_web' => $request->alamat_web,
                'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
            ];

            if ($logo) {
                $logoFileName = $logo->getClientOriginalName();
                $deleteOldPhoto = Storage::delete('public/logo_perusahaan/' . $pk->logo_perusahaan);
                $uploadNewPhoto =  $logo->storeAs('public/logo_perusahaan', $logoFileName);
                $updatePk['logo_perusahaan'] = $logoFileName;
            }

            $pk->update($updatePk);

            $kontak = Kontak::where('id_penyedia_kerja', $pk->id)
                ->update([
                    'no_hp' => $request->no_hp,
                    'email' => $request->email,
                    'jenis_kontak' => 2
                ]);

            $dokumen = DokumenPerusahaan::where('id_penyedia_kerja', $pk->id);
            $updateDok = [];
            if ($npwp || $sop || $surat) {
                $npwpFileName = $npwp->getClientOriginalName();
                $sopFileName = $sop->getClientOriginalName();
                $suratFileName = $surat->getClientOriginalName();

                $deleteOldNpwp = Storage::delete('public/npwp/' . $dokumen->npwp);
                $uploadNewNpwp =  $logo->storeAs('public/npwp', $npwpFileName);

                $deleteOldSop = Storage::delete('public/sop/' . $dokumen->sop);
                $uploadNewSop =  $logo->storeAs('public/sop', $sopFileName);

                $deleteOldSurat = Storage::delete('public/surat/' . $dokumen->surat_domisili);
                $uploadNewSurat =  $logo->storeAs('public/surat', $suratFileName);

                $updateDok['npwp'] = $npwpFileName;
                $updateDok['sop'] = $sopFileName;
                $updateDok['surat_domisili'] = $suratFileName;
            }

            $dokumen->update($updateDok);

            $lokasi = Lokasi::where('id_penyedia_kerja', $pk->id)
                ->update([
                    'nama_lokasi' => $request->alamat_perusahaan,
                    'id_provinsi' => $request->indonesia_provinces,
                    'id_kota' => $request->indonesia_cities,
                    'id_kecamatan' => $request->indonesia_districts,
                    'id_kelurahan' => $request->indonesia_villages,
                ]);

            $bidangPerusahaan = BidangPerusahaan::where('id_penyedia_kerja', $pk->id);

            $bidangPerusahaan->delete();

            $finalArray = array();
            foreach ($request->bidang_usaha as $value) {
                array_push($finalArray, array(
                    'id_kategori_pekerjaan' =>  $value,
                    'id_penyedia_kerja' =>  $pk->id,
                    'created_at' => date('Y-m-d H:i:s')
                ));
            };

            BidangPerusahaan::insert($finalArray);

            DB::commit();

            return redirect()->route('perusahaan.data')
                ->with('success', 'Data Perusahaan updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function lowongan()
    {
      $user = $this->getUserData();
      $perusahaan = PenyediaKerja::where('id_user', $user->id)->first();
      $lowongan = Lowongan::all()->where('id_penyedia_kerja', $perusahaan->id);
      if(!empty($perusahaan)) {
        if ($perusahaan->status_perusahaan == 0) {
            return redirect()->route('perusahaan.data')->with(['error' => 'Perusahaan anda belum disetujui!']);
          }else {
            return view('perusahaan.lowongan.index')->with(['data' => $this->getUserData(), 'lowongan' => $lowongan]);
          }
      } else {
        return redirect()->route('perusahaan.data')->with(['error' => 'Isi Data Perusahaan Terlebih dahulu!']);
      }

    }

    public function lowonganCreate()
    {
        $ktgPekerjaan = KategoriPekerjaan::orderBy('nama_kategori_pekerjaan')->pluck('nama_kategori_pekerjaan', 'id');
        $kota = Kota::all();

      return view('perusahaan.lowongan.create')->with([
        'ktgPekerjaan' => $ktgPekerjaan,
        'kota' => $kota,
        'data' => $this->getUserData()
      ]);
    }

    public function lowonganStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $user = $this->getUserData();
            $perusahaan = PenyediaKerja::where('id_user', $user->id)->first();

            $gaji = preg_replace("/[^0-9]/", '', $request->gaji);

            if (!empty($perusahaan)) {
                $gaji = preg_replace("/[^0-9]/", '', $request->gaji);

                if ($user->type == 99 || $user->type == 2) {

                    $loker = Lowongan::create([
                        'nama_pekerjaan' => $request->nama_pekerjaan,
                        'id_penyedia_kerja' =>  $perusahaan->id,
                        'gaji' => (int)$gaji,
                        'tanggal_dibuka' => $request->tanggal_dibuka,
                        'tanggal_ditutup' => $request->tanggal_ditutup,
                        'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
                        'kualifikasi' => $request->kualifikasi,
                        'gambaran_perusahaan' => $request->gambaran_perusahaan,
                        'keahlian_dibutuhkan' => $request->skill
                    ]);

                    $kategoriLoker = array();
                    foreach ($request->kategori_lowongan as $value) {
                        array_push($kategoriLoker, array(
                            'id_kategori_pekerjaan' =>  $value,
                            'id_lowongan' =>  $loker->id,
                            'created_at' => date('Y-m-d H:i:s')
                        ));
                    };

                    KategoriLowongan::insert($kategoriLoker);

                    $lokasiLoker = array();
                    foreach ($request->kota_penempatan as $value) {
                        array_push($lokasiLoker, array(
                            'id_lokasi' =>  $value,
                            'id_lowongan' =>  $loker->id,
                            'created_at' => date('Y-m-d H:i:s')
                        ));
                    };

                    LokasiLowongan::insert($lokasiLoker);

                    DB::commit();

                    return redirect()->route('perusahaan.lowongan')
                        ->with('success', 'Lowongan created successfully.');
                } else {
                    DB::rollback();
                    return redirect()->back()->withErrors(['error' => "Role user tidak diizikan"]);
                }
            } else {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => "Data Perusahaan Tidak Ada"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function lowonganEdit($id)
    {
        $ktgPekerjaan = KategoriPekerjaan::all();
        $kota = Kota::all();

        $lowongan = Lowongan::where('id', $id)->first();

        $ktgLoker = KategoriLowongan::all()->where('id_lowongan', $lowongan->id);
        $lokasiLoker = LokasiLowongan::all()->where('id_lowongan', $lowongan->id);

      return view('perusahaan.lowongan.edit')->with([
        'ktgPekerjaan' => $ktgPekerjaan,
        'kota' => $kota,
        'data' => $this->getUserData(),
        'lowongan' => $lowongan,
        'lokasiLoker' => $lokasiLoker,
        'ktgLoker' => $ktgLoker
      ]);
    }

    public function lowonganUpdate(Request $request) {
        DB::beginTransaction();

        try {
            $user = $this->getUserData();

            $gaji = preg_replace("/[^0-9]/", '', $request->gaji);

            $kualifikasi = [];
            foreach ($request->kualifikasi as $kua) {
                if ($kua != null) {
                    $kualifikasi[] = $kua;
                }
            }
            $kualifikasi = json_encode($kualifikasi);

            $skill = [];
            foreach ($request->skill as $ski) {
                if ($ski != null) {
                    $skill[] = $ski;
                }
            }
            $skill = json_encode($skill);

            if ($user->type == 99 || $user->type == 2) {

                $id = $request->id;

                $loker = Lowongan::where('id', $id)->first();

                $Updateloker = [
                    'nama_pekerjaan' => $request->nama_pekerjaan,
                    'gaji' => (int)$gaji,
                    'tanggal_dibuka' => $request->tanggal_dibuka,
                    'tanggal_ditutup' => $request->tanggal_ditutup,
                    'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
                    'kualifikasi' => $request->kualifikasi,
                    'gambaran_perusahaan' => $request->gambaran_perusahaan,
                    'keahlian_dibutuhkan' => $request->skill
                ];

                $loker->update($Updateloker);

                $ktgLoker = KategoriLowongan::where('id_lowongan', $loker->id);

                $ktgLoker->delete();

                $kategoriLoker = array();
                foreach ($request->kategori_lowongan as $value) {
                    array_push($kategoriLoker, array(
                        'id_kategori_pekerjaan' =>  $value,
                        'id_lowongan' =>  $loker->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ));
                };

                KategoriLowongan::insert($kategoriLoker);

                $lokLoker = LokasiLowongan::where('id_lowongan', $loker->id);

                $lokLoker->delete();

                $lokasiLoker = array();
                foreach ($request->kota_penempatan as $value) {
                    array_push($lokasiLoker, array(
                        'id_lokasi' =>  $value,
                        'id_lowongan' =>  $loker->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ));
                };

                LokasiLowongan::insert($lokasiLoker);

                DB::commit();

                return redirect()->route('perusahaan.lowongan')
                    ->with('success', 'Lowongan updated successfully.');
            } else {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => "Role user tidak diizikan"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getLine()]);
        }
    }

    public function lowonganShow($id)
    {
        $lowongan = Lowongan::where('id', $id)->first();

        $ktgLoker = KategoriLowongan::all()->where('id_lowongan', $lowongan->id);
        $lokasiLoker = LokasiLowongan::all()->where('id_lowongan', $lowongan->id);

      return view('perusahaan.lowongan.show')->with([
        'data' => $this->getUserData(),
        'lowongan' => $lowongan,
        'lokasiLoker' => $lokasiLoker,
        'ktgLoker' => $ktgLoker
      ]);
    }

    public function lowonganDelete($id)
    {
        $lowongan = Lowongan::where('id', $id)->delete();

        return redirect()->route('perusahaan.lowongan')
            ->with('success', 'Lowongan deleted successfully');
    }
}
