@extends('layouts.back-end_layout')

@section('title')
    Tambah Penyedia Kerja
@endsection

@section('content')

<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Penyedia Kerja</h1>
                        <a href="{{ route('penyedia-kerja.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Penyedia Kerja</h6>
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
                            
                            <form action="{{ route('penyedia-kerja.store') }}" method="POST">
                                @csrf
                                                    
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nama Perusahaan: </strong>
                                            <input type="text" name="nama_perusahaan" class="form-control" placeholder="Masukkan Nama Perusahaan">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Bidang Usaha: </strong>
                                            <input type="text" name="bidang_usaha" class="form-control" placeholder="Masukkan Bidang Usaha">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect1">Provinsi</strong>
                                        <select name="indonesia_provinces" class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect2">Kota/Kabupaten</strong>
                                        <select name="indonesia_districts" class="form-control" id="exampleFormControlSelect2">
                                        <option>1</option>
                                        <option>2</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect3">Kecamatan</strong>
                                        <select name="indonesia_cities" class="form-control" id="exampleFormControlSelect3">
                                        <option>1</option>
                                        <option>2</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect4">Kelurahan</strong>
                                        <select name="indonesia_villages" class="form-control" id="exampleFormControlSelect4">
                                        <option>1</option>
                                        <option>2</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Alamat: </strong>
                                            <input type="text" name="id_lokasi" class="form-control" placeholder="Masukkan Alamat Perusahaan">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Website: </strong>
                                            <input type="text" name="alamat_web" class="form-control" placeholder="Masukkan Alamat Website">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Kontak: </strong>
                                            <input type="text" name="id_kontak" class="form-control" placeholder="Masukkan Kontak">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Deskripsi: </strong>
                                            <input type="textarea" name="deskripsi_perusahaan" class="form-control" placeholder="Masukkan Deskripsi Perusahaan">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Dokumen: </strong>
                                        <div class="custom-file mb-3">
                                            <input name="id_dokumen" type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <strong>Logo: </strong>
                                        <div class="custom-file">
                                            <input name="logo_perusahaan" type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-3 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            
                            </form>
                            
                        </div>
                    </div>

@endsection

