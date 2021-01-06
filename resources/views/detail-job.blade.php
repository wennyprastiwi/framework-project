@extends('layouts.front-end_layout')

@section('title')
Web Karir
@endsection

@section('content')

@if ($errors->count() != 0)
    <script>
        $("#applyBtn").click();
    </script>
@endif

<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url('/frontend/images/banner/bnr1.jpg');">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Job Detail</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="#">Home</a></li>
                        <li>Job Detail</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- contact area -->
    <div class="content-block">
        <!-- Job Detail -->
        <div class="section-full content-inner-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="sticky-top">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="m-b30">
                                        <img src="{{ URL::asset('storage/logo_perusahaan/'.$loker->logo_perusahaan) }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="widget bg-white p-lr20 p-t20  widget_getintuch radius-sm">
                                        <h4 class="text-black font-weight-700 p-t10 m-b15">Job Details</h4>
                                        <ul>
                                            <li><i class="ti-location-pin"></i><strong class="font-weight-700 text-black">Penempatan</strong><span class="text-black-light">
                                                @foreach ($lokasi as $lok)
                                                    {{ $loop->first ? '' : ', ' }}
                                                    {{ $lok->kota->name }}
                                                @endforeach
                                                </span>
                                            </li>
                                            <li><i class="ti-money"></i><strong class="font-weight-700 text-black">Salary</strong> {{ 'Rp. '. number_format($loker->gaji,0, ".", ".") }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="job-info-box">
                            <h3 class="m-t0 m-b10 font-weight-700 title-head">
                                <a href="#" class="text-secondry m-r30">{{ $loker->nama_pekerjaan }}</a>
                            </h3>
                            <ul class="job-info">
                                <li><strong>
                                    @foreach ($kategori as $kat)
                                        {{ $loop->first ? '' : ', ' }}
                                        {{ $kat->kategori->nama_kategori_pekerjaan }}
                                    @endforeach
                                </strong></li>
                                <li><strong>Deadline:</strong> {{ $loker->tanggal_ditutup }}</li>
                                <li><i class="ti-location-pin text-black m-r5"></i>
                                    @foreach ($lokasi as $lok)
                                        {{ $loop->first ? '' : ', ' }}
                                        {{ $lok->kota->name }}
                                    @endforeach
                                </li>
                            </ul><br>
                            <h5 class="font-weight-600">Job Description</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            <p>{{ $loker->deskripsi_pekerjaan }}</p>
                            <h5 class="font-weight-600">Gambaran Perusahaan</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            <p>{{ $loker->gambaran_perusahaan }}</p>
                            <h5 class="font-weight-600">Job Requirements</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            <ul class="list-num-count no-round">
                                    @foreach (json_decode($loker->kualifikasi) as $kua)
                                        {{ $loop->first ? '' : ' ' }}
                                        <li>{{ $kua }}</li>
                                    @endforeach
                            </ul>
                            <h5 class="font-weight-600">Skill Requirements</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            <ul class="list-num-count no-round">
                                    @foreach (json_decode($loker->keahlian_dibutuhkan) as $skill)
                                        {{ $loop->first ? '' : ' ' }}
                                        <li>{{ $skill }}</li>
                                    @endforeach
                            </ul>
                            @if (!empty($user))
                                @if ($user->type == 1)
                                    <button type="button" class="site-button" data-toggle="modal" data-target="#modalApply" id="applyBtn">Apply This Job</button>
                                @endif
                            @else
                             <a href="{{ route('login.login') }}" class="site-button">Login For Apply</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalApply" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <form action="{{ route('applyjob') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                    {{ csrf_field() }}
                    {{ $errors }}
                    <div class="modal-header">
                        <h5 class="modal-title float-left" id="scrollmodalLabel">Apply Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ $loker->id }}">
                            <div class="form-group">
                                <label for="alasan">Alasan : </label>
                                <textarea name="alasan" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="section-full content-inner">
        </div>
    </div>
</div>
@endsection
