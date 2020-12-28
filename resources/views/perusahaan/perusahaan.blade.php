@extends('layouts.perusahaan_layout')

@section('title')
    Perusahaan Panel
@endsection

@section('content')

<h1 class="h3 mb-4 text-gray-800">Profile Perusahaan</h1>

<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="card-header">
        <div class="row">
          <div class="col pt-2">
            Data Perusahaan
          </div>
          <div class="text-left">
            <a class="btn btn-primary" href="{{ route('perusahaan.edit') }}">
              Edit Profile
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="media">
          <img class="mr-3" src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="Generic placeholder image">
          <div class="media-body">
            <h5 class="mt-0">Nama Perusahaan</h5>
            <div class="row no-gutters">
                <div class="col-12">Email: </div>
                <div class="col-12">No Telephone: </div>  
                <div class="col-12">Email: </div>    
                <div class="col-12">Alamat Perusahaan: </div>
                <div class="col-12">Provinsi: </div>     
                <div class="col-12">Kota / Kabupaten: </div>  
                <div class="col-12">Kecamatan: </div>  
                <div class="col-12">Kelurahan: </div>  
                <div class="col-12">Bidang Perusahaan: </div> 
                <div class="col-12">Deskripsi Perusahaan: </div>   
                <div class="col-12">NPWP Perusahaan: </div>   
                <div class="col-12">SOP Perusahaan: </div> 
                <div class="col-12">Surat Domisili: </div>   
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection