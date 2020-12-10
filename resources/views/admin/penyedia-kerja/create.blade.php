@extends('layouts.back-end_layout')

@section('title')
    Tambah Penyedia Kerja
@endsection

@section('content')

<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Penyedia Kerja</h1>
                        <a href="{{ route('admin.penyediaKerja') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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

                            <form action="{{ route('penyediaKerja.store') }}" method="POST">
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
                                            <select name="bidang_usaha[]" class="form-control" id="bidangusaha" multiple="multiple" searchable="Search here..">
                                                <option value="">-- Plih Kategori Usaha --</option>
                                                    @foreach ($ktgPekerjaan as $k => $val)
                                                        <option value="{{ $k }}">{{ $val }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect1" id="provinsi">Provinsi</strong>
                                        <select name="indonesia_provinces" class="form-control" id="provinsi">
                                            <option value="">-- Plih Provinsi --</option>
                                                @foreach ($provinsi as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect2" id="kota">Kota/Kabupaten</strong>
                                        <select name="indonesia_cities" class="form-control" id="kota">
                                            <option value="">-- Pilih Kota/Kabupaten</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect3">Kecamatan</strong>
                                        <select name="indonesia_districts" class="form-control" id="kelurahan">
                                            <option value="">-- Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <strong for="exampleFormControlSelect4">Kelurahan</strong>
                                        <select name="indonesia_villages" class="form-control" id="kecamatan">
                                            <option value="">-- Pilih Kelurahan</option>
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
                                            <strong>Email: </strong>
                                            <input type="text" name="email" class="form-control" placeholder="Masukkan Kontak">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>No Telepon: </strong>
                                            <input type="number" name="no_hp" class="form-control" placeholder="Masukkan Kontak">
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
                                            <input name="npwp" type="file" class="custom-file-input" id="npwp">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <strong>Logo: </strong>
                                        <div class="custom-file">
                                            <input name="logo_perusahaan" type="file" class="custom-file-input" id="logo" accept="image/*">
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
@section('pagejs')
<script>
   $(document).ready(function ()
    {
            $('#bidangusaha').multiselect();

            $('select[name="indonesia_provinces"]').on('change',function(){
               var provinsiID = $(this).val();
               console.log(provinsiID);
               if(provinsiID)
               {
                  $.ajax({
                     url : 'getkota/' +provinsiID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        $('select[name="indonesia_cities"]').empty();
                        $.each(data, function(key,value){
                           $('select[name="indonesia_cities"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="indonesia_cities"]').empty();
               }
            });

            $('select[name="indonesia_cities"]').on('change',function(){
               var kotaID = $(this).val();
               console.log(kotaID);
               if(kotaID)
               {
                  $.ajax({
                     url : 'getkecamatan/' +kotaID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        $('select[name="indonesia_districts"]').empty();
                        $.each(data, function(key,value){
                           $('select[name="indonesia_districts"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="indonesia_districts"]').empty();
               }
            });

            $('select[name="indonesia_districts"]').on('change',function(){
               var KecamatanID = $(this).val();
               console.log(KecamatanID);
               if(KecamatanID)
               {
                  $.ajax({
                     url : 'getkelurahan/' +KecamatanID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        $('select[name="indonesia_villages"]').empty();
                        $.each(data, function(key,value){
                           $('select[name="indonesia_villages"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="indonesia_villages"]').empty();
               }
            });
    });
</script>
@endsection

