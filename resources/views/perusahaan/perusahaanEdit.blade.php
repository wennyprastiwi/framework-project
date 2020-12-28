@extends('layouts.perusahaan_layout')

@section('title')
    Perusahaan Panel
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit Perusahaan</h1>
  <a href="{{ route('perusahaan.data') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>


<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit Perusahaan</h6>
  </div>
  <div class="card-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
      @endif
      <span> INI EDIT PERUSAHAAN</span>
  </div>
</div>

@endsection