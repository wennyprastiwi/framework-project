@extends('layouts.perusahaan_layout')

@section('title')
Perusahaan - Buat Lowongan
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Lowongan</h1>
    <a href="{{ route('admin.lowongan') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Lowongan</h6>
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

        <form action="{{ route('lowongan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Perusahaan: </strong>
                        <input type="text" name="nama_perusahaan" class="form-control"
                            placeholder="Masukkan Nama Perusahaan" value="{{ old('nama_perusahaan') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Kategori Lowongan: </strong>
                        <select name="kategori_lowongan[]" class="form-control" id="kategorilowongan" multiple="multiple"
                            required placeholder="Masukkan Kategori Lowongan">
                            <option value="">-- Plih Kategori Lowongan --</option>
                            @foreach ($ktgPekerjaan as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Alamat: </strong>
                        <input type="text" name="alamat_perusahaan" class="form-control"
                            placeholder="Masukkan Alamat Perusahaan" value="{{ old('alamat_perusahaan') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong for="exampleFormControlSelect1">Kota / Kabupaten</strong>
                    <select name="indonesia_cities[]" class="form-control" id="kota" multiple="multiple" placeholder="Masukkan Kota Lowongan">
                        <option value="">-- Plih Kota / Kabupaten --</option>
                        @foreach ($kota as $kot)
                        <option value="{{ $kot->id }}">{{ $kot->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <div class="form-group">
                        <strong>Website: </strong>
                        <input type="text" name="alamat_web" class="form-control" placeholder="Masukkan Alamat Website"
                            value="{{ old('alamat_web') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email: </strong>
                        <input type="text" name="email" class="form-control" placeholder="Masukkan Email"
                            value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No Telepon: </strong>
                        <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No Telp"
                            value="{{ old('no_hp') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Deskripsi: </strong>
                        <textarea type="text" class="form-control" name="deskripsi_perusahaan" id="address" rows="5"
                            placeholder="Masukkan Deskripsi Perusahaan" value="{{ old('deskripsi_perusahaan') }}"
                            required></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>SOP : </strong>
                    <div class="custom-file">
                        <input name="sop" type="file" class="custom-file-input" id="sop" accept=".pdf,.docx">
                        <label class="custom-file-label" for="sop">Choose file</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>Surat Domisili : </strong>
                    <div class="custom-file">
                        <input name="surat_domisili" type="file" class="custom-file-input" id="surat_domisili"
                            accept=".pdf,.docx">
                        <label class="custom-file-label" for="surat_domisili">Choose file</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>NPWP : </strong>
                    <div class="custom-file">
                        <input name="npwp" type="file" class="custom-file-input" id="npwp" accept=".pdf,.docx">
                        <label class="custom-file-label" for="npwp">Choose file</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>Logo : </strong>
                    <div class="custom-file">
                        <input name="logo_perusahaan" type="file" class="custom-file-input" id="logo" accept="image/*">
                        <label class="custom-file-label" for="logo">Choose file</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection
@section('pagejs')
<script>
    $(document).ready(function () {
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#kategorilowongan').select2();

        $('#kategorilowongan').on('change', function () {
            var kategorilowongan = $(this).val();
            console.log(kategorilowongan);
        })

        $('#kota').select2();

        $('#kota').on('change', function () {
            var kota = $(this).val();
            console.log(kota);
        })
    });
</script>
@endsection
