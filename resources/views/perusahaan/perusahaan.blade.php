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
                    Edit Data Perusahaan
                </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="media">
         @if (!empty($perusahaan->logo_perusahaan))
         <img class="mr-3"  src="{{ asset('storage/logo_perusahaan/'.$perusahaan->logo_perusahaan) }}"
         alt="Generic placeholder image"  style="width: 100px" ; height="50px">
         @else
         <img class="mr-3" src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="Generic placeholder image">
         @endif
          <div class="media-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Perusahaan :</strong>
                    {{ $perusahaan->nama_perusahaan }}
                </div>
                <div class="form-group">
                    <strong>No Telephone :</strong>
                    {{ $perusahaan->kontak->no_hp }}
                </div>
                <div class="form-group">
                    <strong>Email :</strong>
                    {{ $perusahaan->kontak->email }}
                </div>
                <div class="form-group">
                    <strong>Alamat Perusahaan :</strong>
                    {{ $perusahaan->lokasi->nama_lokasi }}
                </div>
                <div class="form-group">
                    <strong>Provinsi :</strong>
                    {{ $perusahaan->lokasi->provinsi->name }}
                </div>
                <div class="form-group">
                    <strong>Kota / Kabupaten :</strong>
                    {{ $perusahaan->lokasi->kota->name }}
                </div>
                <div class="form-group">
                    <strong>Kecamatan :</strong>
                    {{ $perusahaan->lokasi->kecamatan->name }}
                </div>
                <div class="form-group">
                    <strong>Kelurahan :</strong>
                    {{ $perusahaan->lokasi->kelurahan->name }}
                </div>
                <div class="form-group">
                    <strong>Bidang Perusahaan :</strong>
                    @foreach ($perusahaan->bidangs as $key => $bidang)
                    {{ $loop->first ? '' : ', ' }}
                    {{ $bidang['kategori']['nama_kategori_pekerjaan'] }}
                    @endforeach
                </div>
                <div class="form-group">
                    <strong>Deskripsi Perusahaan :</strong>
                    {{ $perusahaan->deskripsi_perusahaan }}
                </div>
                <div class="form-group">
                    <strong>NPWP : </strong><br><br>
                    @if (!empty($perusahaan->dokumen->npwp))
                    <button type="button" class="btn btn-secondary">
                        <a class="text-white" download={{$perusahaan->dokumen->npwp}}
                            href="{{ Storage::url('public/npwp/'.$perusahaan->dokumen->npwp) }}">
                            Download NPWP
                        </a>
                    </button>
                    @else
                    "File Tidak Ada"
                    @endif
                </div>
                <div class="form-group">
                    <strong>SOP : </strong><br><br>
                    @if (!empty($perusahaan->dokumen->sop))
                    <button type="button" class="btn btn-secondary">
                        <a class="text-white" download={{$perusahaan->dokumen->sop}}
                            href="{{ Storage::url('public/sop/'.$perusahaan->dokumen->sop) }}">
                            Download SOP
                        </a>
                    </button>
                    @else
                    "File Tidak Ada"
                    @endif
                </div>
                <div class="form-group">
                    <strong>Surat Domisili : </strong><br><br>
                    @if (!empty($perusahaan->dokumen->surat_domisili))
                    <button type="button" class="btn btn-secondary">
                        <a class="text-white" download={{$perusahaan->dokumen->surat_domisili}}
                            href="{{ Storage::url('public/surat/'.$perusahaan->dokumen->surat_domisili) }}">
                            Download Surat Domisili
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
