@extends('layouts.front-end_layout')

@section('title')
    Web Karir
@endsection

@section('content')
<div class="page-content">
    <!-- Section Banner -->
    <div class="dez-bnr-inr dez-bnr-inr-md" style="background-image:url(/frontend/images/main-slider/slide2.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry align-m ">
                <div class="find-job-bx">
                    <p class="site-button button-sm">Find Jobs, Employment & Career Opportunities</p>
                    <h2>Search Between More Them <br /> <span class="text-primary">50,000</span> Open Jobs.</h2>
                    <form class="dezPlaceAni">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Job Title, Keywords, or Phrase</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label>City, State or ZIP</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <select>
                                        <option>Select Sector</option>
                                        <option>Construction</option>
                                        <option>Corodinator</option>
                                        <option>Employer</option>
                                        <option>Financial Career</option>
                                        <option>Information Technology</option>
                                        <option>Marketing</option>
                                        <option>Quality check</option>
                                        <option>Real Estate</option>
                                        <option>Sales</option>
                                        <option>Supporting</option>
                                        <option>Teaching</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <button type="submit" class="site-button btn-block">Find Job</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Section Banner END -->
    <!-- About Us -->
    <div class="section-full job-categories content-inner-2 bg-white"
        style="background-image:url(../images/pattern/pic1.html);">
        <div class="container">
            <div class="section-head d-flex head-counter clearfix">
                <div class="mr-auto">
                    <h2 class="m-b5">Popular Categories</h2>
                    <h6 class="fw3">20+ Catetories work wating for you</h6>
                </div>
                <div class="head-counter-bx">
                    <h2 class="m-b5 counter">1800</h2>
                    <h6 class="fw3">Jobs Posted</h6>
                </div>
                <div class="head-counter-bx">
                    <h2 class="m-b5 counter">4500</h2>
                    <h6 class="fw3">Tasks Posted</h6>
                </div>
                <div class="head-counter-bx">
                    <h2 class="m-b5 counter">1500</h2>
                    <h6 class="fw3">Freelancers</h6>
                </div>
            </div>
            <div class="row sp20">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-location-pin"></i></div>
                            <a href="#" class="dez-tilte">Design, Art & Multimedia</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-location-pin"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-wand"></i></div>
                            <a href="#" class="dez-tilte">Education Training</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-wand"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-wallet"></i></div>
                            <a href="#" class="dez-tilte">Accounting / Finance</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-wallet"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-cloud-up"></i></div>
                            <a href="#" class="dez-tilte">Human Resource</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-cloud-up"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-bar-chart"></i></div>
                            <a href="#" class="dez-tilte">Telecommunications</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-bar-chart"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-tablet"></i></div>
                            <a href="#" class="dez-tilte">Restaurant / Food Service</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-tablet"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-camera"></i></div>
                            <a href="#" class="dez-tilte">Construction / Facilities</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-camera"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper">
                        <div class="icon-content">
                            <div class="icon-md text-primary m-b20"><i class="ti-panel"></i></div>
                            <a href="#" class="dez-tilte">Health</a>
                            <p class="m-a0">198 Open Positions</p>
                            <div class="rotate-icon"><i class="ti-panel"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us END -->
    <!-- Call To Action -->
    <div class="section-full content-inner bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section-head text-center">
                    <h2 class="m-b5">Featured Cities</h2>
                    <h6 class="fw4 m-b0">20+ Featured Cities Added Jobs</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic1.jpg)">
                        <div class="city-info">
                            <h5>Surabaya</h5>
                            <span>765 Jobs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic2.jpg)">
                        <div class="city-info">
                            <h5>Malang</h5>
                            <span>352 Jobs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic3.jpg)">
                        <div class="city-info">
                            <h5>Indonesia</h5>
                            <span>893 Jobs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic4.jpg)">
                        <div class="city-info">
                            <h5>Jakarta</h5>
                            <span>502 Jobs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic5.jpg)">
                        <div class="city-info">
                            <h5>Bandung</h5>
                            <span>765 Jobs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic6.jpg)">
                        <div class="city-info">
                            <h5>Yogyakarta</h5>
                            <span>352 Jobs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic7.jpg)">
                        <div class="city-info">
                            <h5>Semarang</h5>
                            <span>893 Jobs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 m-b30">
                    <div class="city-bx align-items-end  d-flex"
                        style="background-image:url(frontend/images/city/pic8.jpg)">
                        <div class="city-info">
                            <h5>Makassar</h5>
                            <span>502 Jobs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call To Action END -->
    <!-- Our Job -->
    <div class="section-full bg-white content-inner-2">
        <div class="container">
            <div class="d-flex job-title-bx section-head">
                <div class="mr-auto">
                    <h2 class="m-b5">Recent Jobs</h2>
                    <h6 class="fw4 m-b0">20+ Recently Added Jobs</h5>
                </div>
                <div class="align-self-end">
                    <a href="{{ url('job-list') }}" class="site-button button-sm">Browse All Jobs <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
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
                                            <img src="{{ URL::asset('storage/logo_perusahaan/'.$loker->logo_perusahaan) }}" width="150px">
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
                </div>
                @if (empty($user->id))
                <div class="col-lg-3">
                    <div class="sticky-top">
                        <div class="quote-bx">
                            <div class="quote-info">
                                <h4>Make a Difference with Your Online Resume!</h4>
                                <p>Your resume in minutes with JobBoard resume assistant is ready!</p>
                                <a href="#" class="site-button">Create an Account</a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-3">
                    <div class="sticky-top">
                        <div class="quote-bx">
                            <div class="quote-info">
                                <h4>Make a Difference with Your Online Resume!</h4>
                                <p>Completed your resume in minutes with JobBoard!</p>
                                <a href="#" class="site-button">Completed Resume</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Our Job END -->
</div>
@endsection
