@extends('layouts.perusahaan_layout')

@section('title')
Profile
@endsection

@section('content')

<h1 class="h3 mb-4 text-gray-800">Halaman Profile</h1>

<div class="row">
    <div class="col-sm-6">
        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col pt-2">
                        Data Diri
                    </div>
                    <a class="btn btn-primary" href="{{ route('perusahaan.profile-edit') }}">
                        Edit Profile
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('update-user-success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="media">
                    <img class="mr-3" src="{{ asset('sb-admin/img/undraw_profile.svg') }}"
                        alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $data->username }}</h5>
                        <div class="row no-gutters">
                            <div class="col">Email: {{ $data->email_user }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col pt-2">
                        Ubah Password
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('update-pass-success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <form action="{{ route('perusahaan.profile-pass') }}" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="password" name="password" class="form-control">
                            </div>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                            @endif
                            <div class="form-group">
                                <strong>Ulang Password:</strong>
                                <input type="password" name="repassword" class="form-control">
                            </div>
                            @if ($errors->has('repassword'))
                                <div class="alert alert-danger">{{ $errors->first('repassword') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                      <button class="btn btn-primary" type="submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
