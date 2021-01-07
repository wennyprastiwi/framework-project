@extends('layouts.back-end_layout')

@section('title')
    Admin Panel
@endsection

@section('content')

<h1 class="h3 mb-4 text-gray-800">Halaman About Us</h1>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">About Us</h1>
    <h3 class="display">Sejarah</h3>
    <p class="lead">{{ isset($about->sejarah) ? $about->sejarah : '' }}</p>
    <h3 class="display">Visi</h3>
    <p class="lead">{{ isset($about->visi) ? $about->visi : '' }}</p>
    <h3 class="display">Team Kami</h3>
    <p class="lead">{{ isset($about->misi) ? $about->misi : '' }}</p>
    <h3 class="display">Kontak</h3>
    <p class="lead">{{ isset($about->kontak) ? $about->kontak : '' }}</p>
  </div>
</div>
<div class="row justify-content-center">
    <div class="col col-8">
        <div class="card border-primary text-center text-gray-900">
          <div class="card-body">
            <h5 class="card-title">Edit About Us</h5>
            <form action="{{ route('admin.aboutUsStore') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Sejarah</label>
                    <textarea name="sejarah" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Visi</label>
                  <textarea name="visi" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Misi</label>
                  <textarea name="misi" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kontak</label>
                  <textarea name="kontak" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
    </div>
</div>

@endsection
