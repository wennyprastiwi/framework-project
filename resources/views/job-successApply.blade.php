@extends('layouts.front-end_layout')

@section('title')
Web Karir
@endsection

@section('content')

<div class="page-content">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Success Apply</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="#">Home</a></li>
                        <li>Success Apply</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- Error Page -->
    <div class="section-full content-inner-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 error-page text-center">
                    <h3 class="dz_error text-secondry">Success Apply!</h2>
                    <h4 class="text-primary">Wait For Next Move</h4>
                    <a href="{{ route('pencari.lamaran')}}" class="site-button">Check Your Job Applied</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Error Page END -->
</div>
@endsection
