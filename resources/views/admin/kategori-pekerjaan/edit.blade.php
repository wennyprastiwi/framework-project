@extends('layouts.back-end_layout')

@section('title')
    Master Kategori Pekerjaan
@endsection

@section('content')

<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Kategori Pekerjaan</h1>
                        <a href="{{ route('admin.kategoriPekerjaan') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kategori Pekerjaan</h6>
                        </div>
                        <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @foreach ($kategori as $kp)
                        <form action="{{ route('kategoriPekerjaan.update',$kp->id) }}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Kategori Pekerjaan:</strong>
                                        <input type="hidden" name="id" value="{{ $kp->id }}" class="form-control">
                                        <input type="text" name="nama_kategori_pekerjaan" value="{{ $kp->nama_kategori_pekerjaan }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                        </div>
                    </div>
@endsection

