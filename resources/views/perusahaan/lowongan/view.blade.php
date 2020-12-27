@extends('layouts.perusahaan_layout')

@section('title')
Perusahaan - Lowongan
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
                <h5 class="card-title">Nama Pekerjaan</h5>
                <p class="card-text">Lokasi:</p>
                <p class="card-text">Gaji:</p>
                <p class="card-text">Tanggal Dibuka:</p>
                <p class="card-text">Tanggal Ditutup:</p>
                <p class="card-text">Deskripsi:</p>
                <p class="card-text">Kualifikasi:</p>
                <p class="card-text">Keaflian Dibutuhkan:</p>
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