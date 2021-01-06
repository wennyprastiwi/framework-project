<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriLowongan;
use App\Models\Lamaran;
use App\Models\LokasiLowongan;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\PencariKerja;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LowonganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->type == 1 || $user->type == 99) {
            $lowongan = DB::table('lowongan')
                ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
                ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
                ->whereRaw('tanggal_ditutup > now()')
                ->paginate(10);

            return response()->json([
                'status_code' => 200,
                'message' => $lowongan,

            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'User not accepted',
            ]);
        }

    }

    public function detail($id)
    {
        $loker = DB::table('lowongan')
            ->selectRaw('lowongan.* , pk.nama_perusahaan , pk.logo_perusahaan')
            ->leftJoin('penyedia_kerja as pk', 'pk.id', '=', 'lowongan.id_penyedia_kerja')
            ->where(['lowongan.id' => $id])
            ->first();

        $kategoriLoker = KategoriLowongan::all()->where('id_lowongan', $loker->id)->take(2);

        $lokasiLoker = LokasiLowongan::all()->where('id_lowongan', $loker->id)->take(2);

        return response()->json([
            'status_code' => 200,
            'message' => [
                $loker,
                $kategoriLoker,
                $lokasiLoker
            ],
        ]);
    }

    public function apply(Request $request)
    {
        $user = Auth::user();
        $biodata = PencariKerja::where('id_user', $user->id)->where('status_pencari', 1)->first();

        if (!empty($biodata)) {
            $lamaran = Lamaran::where('id_pencari_kerja', $biodata->id)->first();
            if (empty($lamaran)) {
                Lamaran::create([
                    'id_lowongan' => $request->loker_id,
                    'id_pencari_kerja' => $biodata->id,
                    'alasan' => $request->alasan,
                    'status_lamaran' => 0
                ]);
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Job Success Apply'
                ]);
            } else {
                return response()->json([
                    'status_code' => 400,
                    'message' => 'Lamaran Founded',
                ]);
            }
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Apply Failed , Biodata Not Found or User not Accepted.',
            ]);
        }
    }
}
