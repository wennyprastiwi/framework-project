@extends('layouts.back-end_layout')

@section('title')
    Admin Panel
@endsection

@section('content')

<h1 class="h3 mb-4 text-gray-800">Halaman About Us</h1>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">About Us</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>
<div class="row justify-content-center">
    <div class="col col-8">
        <div class="card border-primary text-center text-gray-900">
          <div class="card-body">
            <h5 class="card-title">Edit About Us</h5>
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Masukkan kalimat untuk about us</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
    </div>
</div>

@endsection
