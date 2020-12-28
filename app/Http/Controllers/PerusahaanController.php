<?php

namespace App\Http\Controllers;

use App\Models\PenyediaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PenyediaKerjaController as pnydKerjaCtrl;

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
      return view('perusahaan.perusahaan')->with(['data' => $this->getUserData()]);
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
