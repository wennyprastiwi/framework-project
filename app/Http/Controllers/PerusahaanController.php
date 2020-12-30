<?php

namespace App\Http\Controllers;

use App\Models\PenyediaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PenyediaKerjaController as pnydKerjaCtrl;
use App\Models\KategoriPekerjaan;
use App\Models\Provinsi;

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

        $provinsi = Provinsi::all();
        $ktgPekerjaan = KategoriPekerjaan::orderBy('nama_kategori_pekerjaan')->pluck('nama_kategori_pekerjaan', 'id');

      return view('perusahaan.perusahaan')->with([
        'provinsi' => $provinsi,
        'ktgPekerjaan' => $ktgPekerjaan,
        'data' => $this->getUserData()
        ]);
    }

    public function perusahaanEdit()
    {
      return view('perusahaan.perusahaanEdit')->with(['data' => $this->getUserData()]);
    }

    public function lowongan()
    {
      return view('perusahaan.lowongan.index')->with(['data' => $this->getUserData()]);
    }

    public function lowonganCreate()
    {
      return view('perusahaan.lowongan.create')->with(['data' => $this->getUserData()]);
    }

    public function lowonganView()
    {
      return view('perusahaan.lowongan.view')->with(['data' => $this->getUserData()]);
    }
}
