<?php

namespace App\Http\Controllers;

use App\Models\KategoriLowongan;
use App\Models\KategoriPekerjaan;
use App\Models\Kota;
use App\Models\LokasiLowongan;
use App\Models\Lowongan;
use App\Models\PenyediaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LowonganController extends Controller
{
    private function getAdminData()
    {
        return $admin = Auth::user();
    }

    public static function get($filter = NULL)
    {
        if ($filter == NULL) {
            return Lowongan::all();
        }
        return Lowongan::where($filter)->get();
    }

    public function create()
    {
        $ktgPekerjaan = KategoriPekerjaan::orderBy('nama_kategori_pekerjaan')->pluck('nama_kategori_pekerjaan', 'id');
        $kota = Kota::all();

        return view('admin.lowongan.create')->with([
            'ktgPekerjaan' => $ktgPekerjaan,
            'kota' => $kota,
            'admin' => $this->getAdminData()
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $user = $this->getAdminData();
            $perusahaan = PenyediaKerja::where('id_user', $user->id)->first();

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

                    return redirect()->route('admin.lowongan')
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


    public function edit($id)
    {
        $ktgPekerjaan = KategoriPekerjaan::all();
        $kota = Kota::all();

        $lowongan = Lowongan::where('id', $id)->first();

        $ktgLoker = KategoriLowongan::all()->where('id_lowongan', $lowongan->id);
        $lokasiLoker = LokasiLowongan::all()->where('id_lowongan', $lowongan->id);

        return view('admin.lowongan.edit')->with([
            'ktgPekerjaan' => $ktgPekerjaan,
            'kota' => $kota,
            'admin' => $this->getAdminData(),
            'lowongan' => $lowongan,
            'lokasiLoker' => $lokasiLoker,
            'ktgLoker' => $ktgLoker
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            // dd($request);

            $user = $this->getAdminData();

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

                return redirect()->route('admin.lowongan')
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

    public function show($id)
    {
        $lowongan = Lowongan::where('id', $id)->first();

        $ktgLoker = KategoriLowongan::all()->where('id_lowongan', $lowongan->id);
        $lokasiLoker = LokasiLowongan::all()->where('id_lowongan', $lowongan->id);

        return view('admin.lowongan.show')->with([
            'admin' => $this->getAdminData(),
            'lowongan' => $lowongan,
            'lokasiLoker' => $lokasiLoker,
            'ktgLoker' => $ktgLoker
        ]);
    }

    public function delete($id)
    {
        $lowongan = Lowongan::where('id', $id)->delete();

        return redirect()->route('admin.lowongan')
            ->with('success', 'Lowongan deleted successfully');
    }
}
