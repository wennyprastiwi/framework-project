@extends('layouts.back-end_layout')

@section('title')
    Master Pencari kerja
@endsection

@section('content')

<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Master Pencari Kerja</h1>
                        <a href={{ route('pencariKerja.create') }} class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pencari kerja</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pencariKerja as $pk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pk->nik }}</td>
                                            <td>{{ $pk->nama_lengkap }}</td>
                                            <td>
                                                {{-- <form action="{{ route('pencariKerja.delete',$pk->id) }}" method="POST">
                                                <a href="{{ route('pencariKerja.show',$pk->id) }}" class="btn btn-info btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </a>
                                                <a href="{{ route('pencariKerja.edit',$pk->id) }}" class="btn btn-secondary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="far fa-edit"></i>
                                                    </span>
                                                </a>

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button> --}}
                                                {{-- @if ($pk->status_perusahaan == 0)
                                                <a href="{{ route('pencariKerja.accepted',$pk->id) }}" class="btn btn-warning btn-icon-split" data-toggle="tooltip" title="Klik untuk menerima">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                </a>
                                                <a href="{{ route('pencariKerja.decline',$pk->id) }}" class="btn btn-danger btn-icon-split" data-toggle="tooltip" title="Klik untuk menolak">
                                                    <span class="icon text-white-50">
                                                        <i class="fa fa-ban"></i>
                                                    </span>
                                                </a>
                                                @endif --}}
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

