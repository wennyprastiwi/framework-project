@extends('layouts.back-end_layout')

@section('title')
    Profile
@endsection

@section('content')

<h1 class="h3 mb-4 text-gray-800">Halaman Profile</h1>

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col pt-2">
            Data Diri
          </div>
          <div class="text-left">
            <button class="btn btn-primary" href="">
              Edit Profile
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="media">
          <img class="mr-3" src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="Generic placeholder image">
          <div class="media-body">
            <h5 class="mt-0">{{ $admin->nama_user }}</h5>
            <div class="row no-gutters">
                <div class="col">Email: {{ $admin->email_user }}</div>    
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col pt-2">
            Ubah Password
          </div>
          <div class="text-left">
            <button class="btn btn-primary" href="">
              Ubah
            </button>
          </div>
        </div>       
      </div>
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
</div>

@endsection