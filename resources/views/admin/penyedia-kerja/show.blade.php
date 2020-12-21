@extends('layouts.back-end_layout')

@section('title')
    Master Penyedia Kerja
@endsection

@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Lihat Data</h1>
                        <a href="{{ route('admin.penyediaKerja') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Penyedia Kerja</h6>
                        </div>
                        {{-- @foreach($penyediaKerja as $pk) --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nama Perusahaan :</strong>
                                        {{ $penyediaKerja->nama_perusahaan }}
                                    </div>
                                    <div class="form-group">
                                        <strong>No Telephone :</strong>
                                        {{ $penyediaKerja->kontak->no_hp }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Email :</strong>
                                        {{ $penyediaKerja->kontak->email }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Alamat Perusahaan :</strong>
                                        {{ $penyediaKerja->lokasi->nama_lokasi }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Provinsi :</strong>
                                        {{ $penyediaKerja->lokasi->provinsi->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Kota / Kabupaten :</strong>
                                        {{ $penyediaKerja->lokasi->kota->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Kecamatan :</strong>
                                        {{ $penyediaKerja->lokasi->kecamatan->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Kelurahan :</strong>
                                        {{ $penyediaKerja->lokasi->kelurahan->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Bidang Perusahaan :</strong>
                                        @foreach ($penyediaKerja->bidangs as $key => $bidang)
                                            {{ $loop->first ? '' : ', ' }}
                                            {{ $bidang['kategori']['nama_kategori_pekerjaan'] }}
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <strong>Deskripsi Perusahaan :</strong>
                                        {{ $penyediaKerja->deskripsi_perusahaan }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Logo Perusahaan : </strong><br><br>
                                        @if (!empty($penyediaKerja->logo_perusahaan))
                                            <img class="img-responsive" src="{{ asset('storage/logo_perusahaan/'.$penyediaKerja->logo_perusahaan) }}"
                                            style="width: 200px"; height="200px"
                                            >
                                        @else
                                            "Logo Tidak Ada"
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>NPWP : </strong><br><br>
                                        @if (!empty($penyediaKerja->dokumen->npwp))
                                            <button type="button" class="btn btn-secondary">
                                                <a class="text-white" download={{$penyediaKerja->dokumen->npwp}} href="{{ Storage::url('public/npwp/'.$penyediaKerja->dokumen->npwp) }}">
                                                    Download NPWP
                                                </a>
                                            </button>
                                        @else
                                            "File Tidak Ada"
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>SOP : </strong><br><br>
                                        @if (!empty($penyediaKerja->dokumen->sop))
                                            <button type="button" class="btn btn-secondary">
                                                <a class="text-white" download={{$penyediaKerja->dokumen->sop}} href="{{ Storage::url('public/sop/'.$penyediaKerja->dokumen->sop) }}">
                                                    Download SOP
                                                </a>
                                            </button>
                                        @else
                                            "File Tidak Ada"
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>Surat Domisili : </strong><br><br>
                                        @if (!empty($penyediaKerja->dokumen->surat_domisili))
                                            <button type="button" class="btn btn-secondary">
                                                <a class="text-white" download={{$penyediaKerja->dokumen->surat_domisili}} href="{{ Storage::url('public/surat/'.$penyediaKerja->dokumen->surat_domisili) }}">
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
                        {{-- @endforeach --}}


@endsection
