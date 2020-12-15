<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\KategoriPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KPController extends Controller
{

    public static function index() {
			return KategoriPekerjaan::all();
	}

    public function create(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama_kategori_pekerjaan'     => 'required',
        ],
            [
                'nama_kategori_pekerjaan.required' => 'Masukkan Kategori Pekerjaan !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $kp = KategoriPekerjaan::create([
                'nama_kategori_pekerjaan'     => $request->input('nama_kategori_pekerjaan')
            ]);

            if ($kp) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kategori Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori Gagal Disimpan!',
                ], 401);
            }
        }
    }

    public function show($id)
    {
        $kp = KategoriPekerjaan::whereId($id)->first();


        if ($kp) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Kategori!',
                'data'    => $kp
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kategori Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }

    public function edit(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama_kategori_pekerjaan'     => 'required',
        ],
            [
                'nama_kategori_pekerjaan.required' => 'Masukkan Nama Kategori !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $kp = KategoriPekerjaan::whereId($request->input('id'))->update([
                'nama_kategori_pekerjaan'     => $request->input('nama_kategori_pekerjaan'),
            ]);

            if ($kp) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kategori Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori Gagal Diupdate!',
                ], 401);
            }

        }

    }

    public function destroy($id)
    {
        $kp = KategoriPekerjaan::findOrFail($id);
        $kp->delete();

        if ($kp) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kategori Gagal Dihapus!',
            ], 400);
        }

    }
}