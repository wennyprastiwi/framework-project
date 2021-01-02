@extends('layouts.back-end_layout')

@section('title')
Lowongan
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lowongan </h1>
</div>

<div class="card border-secondary shadow h-100">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                    aria-controls="detail" aria-selected="true">Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pelamar-tab" data-toggle="tab" href="#pelamar" role="tab"
                    aria-controls="pelamar" aria-selected="false">Pelamar</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Pekerjaan :</strong>
                        {{ $lowongan->nama_pekerjaan }}
                    </div>
                    <div class="form-group">
                        <strong>Nama Perusahaan :</strong>
                        {{ $lowongan->perusahaan->nama_perusahaan }}
                    </div>
                    <div class="form-group">
                        <strong>Gaji :</strong>
                        {{ $lowongan->gaji }}
                    </div>
                    <div class="form-group">
                        <strong>Tanggal dibuka :</strong>
                        {{ $lowongan->tanggal_dibuka }}
                    </div>
                    <div class="form-group">
                        <strong>Tanggal ditutup :</strong>
                        {{ $lowongan->tanggal_ditutup }}
                    </div>
                    <div class="form-group">
                        <strong>Lokasi Penempaten :</strong>
                        @foreach ($lokasiLoker as $key => $lok)
                        {{ $loop->first ? '' : ', ' }}
                        {{ $lok->kota->name }}
                        @endforeach
                    </div>
                    <div class="form-group">
                        <strong>Kategori Lowongan :</strong>
                        @foreach ($ktgLoker as $kat)
                            {{ $loop->first ? '' : ', ' }}
                            {{ $kat->kategori->nama_kategori_pekerjaan }}
                        @endforeach
                    </div>
                    <div class="form-group">
                        <strong>Deskripsi Pekerjaan :</strong>
                        {{ $lowongan->deskripsi_pekerjaan }}
                    </div>
                    <div class="form-group">
                        <strong>Gambaran Perusahaan :</strong>
                        {{ $lowongan->gambaran_perusahaan }}
                    </div>
                    <div class="form-group">
                        <strong>Kualifikasi :</strong>
                        @foreach (json_decode($lowongan->kualifikasi) as $kua)
                            {{ $loop->first ? '' : ', ' }}
                            {{ $kua }}
                        @endforeach
                    </div>
                    <div class="form-group">
                        <strong>Skill :</strong>
                        @foreach (json_decode($lowongan->keahlian_dibutuhkan) as $skill)
                            {{ $loop->first ? '' : ', ' }}
                            {{ $skill }}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pelamar" role="tabpanel" aria-labelledby="pelamar-tab">
                <h5 class="card-title">Pelamar</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead aria-rowspan="2">
                            <tr>
                                <th>No</th>
                                <th>Nama Pelamar</th>
                                <th>CV</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Aktif</td>
                                <td>Donlot</td>

                                <td>
                                    <form action="" method="POST">
                                        <a href="" class="btn btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </a>
                                        <a href="" class="btn btn-secondary btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="far fa-edit"></i>
                                            </span>
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-icon-split"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('pagejs')

<!-- Page level plugins -->
<script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>

@endsection
