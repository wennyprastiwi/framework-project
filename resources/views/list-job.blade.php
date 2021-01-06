@extends('layouts.front-end_layout')

@section('title')
Web Karir
@endsection

@section('content')

<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(frontend/images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Browse Jobs</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="#">Home</a></li>
                        <li>Browse Jobs</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- contact area -->
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full bg-white browse-job content-inner-2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <h5 class="widget-title font-weight-700 text-uppercase">Recent Jobs</h5>
                        <ul class="post-job-bx">
                            @foreach ($lowongan as $loker)
                            @php
                            $lokasiLoker = DB::table('lokasi_lowongan')
                            ->selectRaw('lokasi_lowongan.* , kota.name')
                            ->where(['id_lowongan' => $loker->id])
                            ->leftJoin('indonesia_cities as kota', 'kota.id', '=', 'lokasi_lowongan.id_lokasi' )
                            ->get();
                            @endphp
                            <li>
                                <a href="{{ route('jobdetail',$loker->id) }}">
                                    <div class="d-flex m-b30">
                                        <div class="job-post-company">
                                            @if (!empty($loker->logo_perusahaan))
                                            <img src="{{ URL::asset('storage/logo_perusahaan/'.$loker->logo_perusahaan) }}"
                                                width="150px">
                                            @else
                                            <span><img src="frontend/images/logo/icon1.png" /></span>
                                            @endif
                                        </div>
                                        <div class="job-post-info">
                                            <h4> {{ $loker->nama_pekerjaan }}</h4>
                                            <ul>
                                                <li><i class="fa fa-briefcase"></i> {{ $loker->nama_perusahaan }}</li>
                                                <li><i class="fa fa-map-marker"></i>
                                                    @foreach ($lokasiLoker as $key => $lok)
                                                    {{ $loop->first ? '' : ', ' }}
                                                    {{ $lok->name }}
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="salary-bx ml-auto">
                                            <span>{{ 'Rp. '. number_format($loker->gaji,0, ".", ".") }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="pagination-bx m-t30">
                            {{ $lowongan->links() }}
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="sticky-top">
                            <div class="clearfix m-b30">
                                <h5 class="widget-title font-weight-700 text-uppercase">Keywords</h5>
                                <div class="">
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="clearfix m-b10">
                                <h5 class="widget-title font-weight-700 m-t0 text-uppercase">Location</h5>
                                <input type="text" class="form-control m-b30" placeholder="Location">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
