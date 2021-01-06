@extends('layouts.pencari_layout')

@section('title')
    Pencari Panel
@endsection

@section('content')

<h1 class="h3 mb-4 text-gray-800">Biodata</h1>
<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="card-header">
        <div class="row">
          <div class="col pt-2">
            Biodata
          </div>
          <div class="text-left">
                <a class="btn btn-primary" href="{{ route('pencari.edit') }}">
                    Edit Biodata
                </a>
                <a class="btn btn-primary" href="{{ route('pencari.show') }}">
                    Detail Biodata
                </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="media">
         {{-- @if (!empty($pencari->logo_pencari))
         <img class="mr-3"  src="{{ asset('storage/logo_pencari/'.$pencari->logo_pencari) }}"
         alt="Generic placeholder image"  style="width: 100px" ; height="50px">
         @else
         <img class="mr-3" src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="Generic placeholder image">
         @endif --}}
          <div class="media-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Pencari :</strong>
                    {{ $pencari->nama_lengkap }}
                </div>
                <div class="form-group">
                    <strong>NIK :</strong>
                    {{ $pencari->nik }}
                </div>
                <div class="form-group">
                    <strong>Email :</strong>
                    {{ $data->email_user }}
                </div>
                <div class="form-group">
                    <strong>Tempat Lahir :</strong>
                    {{ $pencari->tempat_lahir }}
                </div>
                <div class="form-group">
                    <strong>Tanggal Lahir :</strong>
                    {{ $pencari->tanggal_lahir }}
                </div>
                <div class="form-group">
                    <strong>Alamat :</strong>
                    {{ $pencari->lokasi->nama_lokasi }}
                </div>
                <div class="form-group">
                    <strong>Agama :</strong>
                    {{ $agama->nama_agama }}
                </div>
                <div class="form-group">
                    <strong>Jenis Kelamin :</strong>
                    @if ($pencari->jenis_kelamin == 1)
                        Laki-laki
                    @else
                        Perempuan
                    @endif
                </div>
                <div class="form-group">
                    <strong>Status Pernikahan :</strong>
                    {{ $pencari->status_pernikahan }}
                </div>
                <div class="form-group">
                    <strong>CV : </strong><br><br>
                    @if (!empty($pencari->file_cv))
                    <button type="button" class="btn btn-secondary">
                        <a class="text-white" download={{$pencari->file_cv}}
                            href="{{ Storage::url('public/cv_pencari/'.$pencari->file_cv) }}">
                            Download CV
                        </a>
                    </button>
                    @else
                    "File Tidak Ada"
                    @endif
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
