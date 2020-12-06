@extends('layouts.back-end_layout')

@section('title')
    Master user
@endsection

@section('content')

<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
                        <a href="{{ route('user.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
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

                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Username</strong>
                                            <input type="text" name="nama_user" class="form-control" placeholder="Masukkan username">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>email:</strong>
                                            <input type="text" name="email_user" class="form-control" placeholder="Masukkan email">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Password:</strong>
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

@endsection

