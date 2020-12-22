@extends('layouts.back-end_layout')

@section('title')
Tambah Pencari Kerja
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Pencari Kerja</h1>
    <a href="{{ route('admin.pencariKerja') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pencari Kerja</h6>
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

        <form action="{{ route('pencariKerja.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama lengkap : </strong>
                        <input type="text" name="nama_lengkap" class="form-control"
                            placeholder="Masukkan Nama lengkap" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>NIK : </strong>
                        <input type="text" name="nik" class="form-control"
                            placeholder="Masukkan NIK " required>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <strong for="exampleFormControlSelect1">Tempat lahir</strong>
                    <select name="tempat_lahir" class="form-control" id="tempatlahir">
                        <option value="">-- Plih Tempat lahir --</option>
                        @foreach ($kota as $tmplhr)
                            <option value="{{ $tmplhr->name }}">{{ $tmplhr->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Tanggal lahir : </strong>
                        <input type="text" name="tanggal_lahir" class="date form-control" id="tanggallahir" placeholder="Masukkan Tanggal lahir" required>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <strong for="exampleFormControlSelect1">Agama</strong>
                    <select name="agama" class="form-control" id="agama">
                        <option value="">-- Plih Agama --</option>
                        @foreach ($agama as $agm)
                            <option value="{{ $agm->nama_agama }}">{{ $agm->nama_agama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <strong for="exampleFormControlSelect1">Status Pernikahan</strong>
                    <select name="status_pernikahan" class="form-control" id="statuspernikahan">
                        <option value="">-- Plih Status Pernikahan --</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Lajang">Lajang</option>
                        <option value="Cerai">Cerai</option>
                    </select>
                </div>
            </div>
            <div class="row" id="tablePekerjaan">
                <div  class="col-xs-3 col-sm-3 col-md-4">
                    <div class="form-group">
                        <strong>Nama Pekerjaan : </strong>
                        <input type="text" name="nama_pekerjaan" class="form-control"
                            placeholder="Masukkan Nama Pekerjaan " required>
                    </div>
                </div>
                <div  class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Lokasi Pekerjaan : </strong>
                        <select name="lokasi_pekerjaan" class="form-control" id="lokasikerja">
                            <option value="">-- Plih Lokasi Pekerjaan --</option>
                            @foreach ($kota as $tmplhr)
                                <option value="{{ $tmplhr->name }}">{{ $tmplhr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-2">
                    <div class="form-group">
                        <strong>Tanggal Masuk : </strong>
                        <input type="text" name="tanggal_masuk" class="date form-control" id="tanggalmasuk" placeholder="Tanggal masuk" required>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                        <strong>Tanggal keluar : </strong>
                        <input type="text" name="tanggal_keluar" class="date form-control" id="tanggalkeluar" placeholder="Tanggal keluar" required>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3 text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>
</div>

@endsection
@section('pagejs')
<script>
    $(document).ready(function ()
    {
        var i = 0;
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $('.date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });

            $("#tanggalmasuk").on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                $("#tanggalkeluar").datepicker('setStartDate', startDate);
                if($("#tanggalmasuk").val() > $("#tanggalkeluar").val()){
                $("#tanggalkeluar").val($("#tanggalmasuk").val());
                }
            });

            $("#add").click(function(){
                i++;
                $('#tablePekerjaan').append('<div id="removerow"><div class="col-xs-3 col-sm-3 col-md-4"><div class="form-group"><strong>Nama Pekerjaan : </strong><input type="text" name="nama_pekerjaan" class="form-control" placeholder="Masukkan Nama Pekerjaan" required></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><strong>Lokasi Pekerjaan : </strong><select name="lokasi_pekerjaan" class="form-control"><option value="">-- Plih Lokasi Pekerjaan --</option>@foreach ($kota as $tmplhr)<option value="{{ $tmplhr->name }}">{{ $tmplhr->name }}</option>@endforeach</select></div></div><div class="col-xs-3 col-sm-2 col-md-2"><div class="form-group"><strong>Tanggal Masuk : </strong><input type="text" name="tanggal_masuk" class="date form-control" placeholder="Tanggal masuk" required></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><strong>Tanggal keluar : </strong><input type="text" name="tanggal_keluar" class="date form-control" placeholder="Tanggal keluar" required></div></div><div class="mt-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger remove"><i class="fa fa-minus"></i></button></div></div id="removerow">');
            });

            $(document).on('click', '.remove', function(){
                var button_id = $(this).attr("id");
                $(this).parents('#removerow').remove();
            });
    });
</script>
@endsection
