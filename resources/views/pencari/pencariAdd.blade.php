@extends('layouts.pencari_layout')

@section('title')
    Pencari Panel
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Biodata</h1>
    <a href="{{ route('pencari.data') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Biodata</h6>
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

        <form action="{{ route('pencari.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <nav class="nav nav-tab nav-pills nav-justified">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tableDiri">Biodata Diri</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tablePekerjaan">Biodata Pekerjaan</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tablePendidikan">Biodata Pendidikan</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tablePelatihan">Biodata Pelatihan</a>
            </nav>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tableDiri">
                    <div class="row mt-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nama lengkap : </strong>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    placeholder="Masukkan Nama lengkap">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>NIK : </strong>
                                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK ">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <strong for="exampleFormControlSelect1">Tempat lahir</strong>
                            <select name="tempat_lahir" class="form-control" id="tempatlahir">
                                <option value="">-- Plih Tempat lahir --</option>
                                @foreach ($kota as $tmplhr)
                                <option value="{{ $tmplhr->name }}">{{ $tmplhr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Tanggal lahir : </strong>
                                <input type="text" name="tanggal_lahir" class="date form-control" id="tanggallahir"
                                    placeholder="Masukkan Tanggal lahir">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                            <strong for="exampleFormControlSelect1">Agama</strong>
                            <select name="agama" class="form-control" id="agama">
                                <option value="">-- Plih Agama --</option>
                                @foreach ($agama as $agm)
                                <option value="{{ $agm->id }}">{{ $agm->nama_agama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                            <strong for="exampleFormControlSelect1">Jenis Kelamin</strong>
                            <select name="jenis_kelamin" class="form-control" id="jeniskelamin">
                                <option value="">-- Plih Jenis Kelamin --</option>
                                <option value="1">Laki - Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Alamat : </strong>
                                <input type="text" name="alamat_pencari" class="form-control"
                                    placeholder="Masukkan Alamat Lengkap">
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong for="exampleFormControlSelect1" id="provinsi">Provinsi</strong>
                            <select name="indonesia_provinces" class="form-control" id="provinsi">
                                <option value="">-- Plih Provinsi --</option>
                                @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
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
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <strong for="exampleFormControlSelect1">Status Pernikahan</strong>
                            <select name="status_pernikahan" class="form-control" id="statuspernikahan">
                                <option value="">-- Plih Status Pernikahan --</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Lajang">Lajang</option>
                                <option value="Cerai">Cerai</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <strong>CV : </strong>
                            <div class="custom-file">
                                <input name="file_cv" type="file" class="custom-file-input" id="file_cv"
                                    accept=".pdf,.docx">
                                <label class="custom-file-label" for="file_cv">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tablePekerjaan">
                    <div class="row mt-3">
                        <div class="col-xs-3 col-sm-3 col-md-4">
                            <div class="form-group">
                                <strong>Nama Pekerjaan : </strong>
                                <input type="text" name="nama_pekerjaan[]" class="form-control"
                                    placeholder="Masukkan Nama Pekerjaan ">
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Lokasi Pekerjaan : </strong>
                                <select name="lokasi_kerja[]" class="form-control" id="lokasikerja">
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
                                <input type="text" name="tanggal_masuk[]" class="date form-control tanggalmasuk"
                                    placeholder="Tanggal masuk">
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Tanggal keluar : </strong>
                                <input type="text" name="tanggal_keluar[]" class="date form-control tanggalkeluar"
                                    placeholder="Tanggal keluar">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="button" name="add" id="addPekerjaan" class="btn btn-success"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tablePendidikan">
                    <div class="row mt-3">
                        <div class="col-xs-3 col-sm-3 col-md-4">
                            <div class="form-group">
                                <strong>Nama Instansi / Lembaga : </strong>
                                <input type="text" name="nama_instansi[]" class="form-control"
                                    placeholder="Masukkan Nama Instansi / Lembaga ">
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Tingkat Pendidikan : </strong>
                                <select name="tingkat_pendidikan[]" class="form-control" id="tingkatpendidikan">
                                    <option value="">-- Plih Tingkat Pendidikan --</option>
                                    @foreach ($jnsPendidikan as $tingkatpen)
                                    <option value="{{ $tingkatpen->id }}">
                                        {{ $tingkatpen->nama_jenis_pendidikan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Tahun Masuk : </strong>
                                <input type="text" name="tahun_masuk[]" class="yeargrade form-control tahunmasuk"
                                    placeholder="Tahun Masuk">
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Tahun Lulus : </strong>
                                <input type="text" name="tahun_lulus[]" class="yeargrade form-control tahunkeluar"
                                    placeholder="Tahun Lulus">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="button" name="add" id="addPendidikan" class="btn btn-success"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tablePelatihan">
                    <div class="row mt-3">
                        <div class="col-xs-3 col-sm-3 col-md-6">
                            <div class="form-group">
                                <strong>Nama Pelatihan : </strong>
                                <input type="text" name="nama_pelatihan[]" class="form-control"
                                    placeholder="Masukkan Nama Pelatihan ">
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-6">
                            <div class="form-group">
                                <strong>Tahun Pelatihan : </strong>
                                <input type="text" name="tahun_pelatihan[]"
                                    class="yearskill form-control tahunpelatihan" placeholder="Tahun Pelatihan">
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-12">
                            <div class="form-group">
                                <strong>Deskripsi Pelatihan : </strong>
                                <textarea type="text" class="form-control" name="deskripsi_pelatihan[]"
                                    id="deskpelatihan" rows="3" placeholder="Masukkan Deskripsi Pelatihan"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                            <button type="button" name="add" id="addPelatihan" class="btn btn-success"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
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

            $("#addPekerjaan").click(function(){
                i++;
                $('#tablePekerjaan').append('<div class="row" id="removerow"><div class="col-xs-3 col-sm-3 col-md-4"><div class="form-group"><strong>Nama Pekerjaan : </strong><input type="text" name="nama_pekerjaan[]" class="form-control" placeholder="Masukkan Nama Pekerjaan"></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><strong>Lokasi Pekerjaan : </strong><select name="lokasi_kerja[]" class="form-control"><option value="">-- Plih Lokasi Pekerjaan --</option>@foreach ($kota as $tmplhr)<option value="{{ $tmplhr->name }}">{{ $tmplhr->name }}</option>@endforeach</select></div></div><div class="col-xs-3 col-sm-2 col-md-2"><div class="form-group"><strong>Tanggal Masuk : </strong><input type="text" name="tanggal_masuk[]" class="date form-control tanggalmasuk" placeholder="Tanggal masuk"></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><strong>Tanggal keluar : </strong><input type="text" name="tanggal_keluar[]" class="date form-control tanggalkeluar" placeholder="Tanggal keluar"></div></div><div class="mt-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger remove"><i class="fa fa-minus"></i></button></div></div>');
            });

            $("#addPendidikan").click(function(){
                i++;
                $('#tablePendidikan').append('<div class="row" id="removerow"><div class="col-xs-3 col-sm-3 col-md-4"><div class="form-group"><div class="form-group"><strong>Nama Instansi / Lembaga : </strong><input type="text" name="nama_instansi[]" class="form-control" placeholder="Masukkan Nama Instansi / Lembaga "></div></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><strong>Tingkat Pendidikan : </strong><select name="tingkat_pendidikan[]" class="form-control" id="tingkatpendidikan"><option value="">-- Plih Tingkat Pendidikan --</option>@foreach ($jnsPendidikan as $tingkatpen)<option value="{{ $tingkatpen->id }}">{{ $tingkatpen->nama_jenis_pendidikan }}</option>@endforeach</select></div></div><div class="col-xs-3 col-sm-2 col-md-2"><div class="form-group"><strong>Tahun Masuk : </strong><input type="text" name="tahun_masuk[]" class="yeargrade form-control tahunmasuk" placeholder="Tahun Masuk"></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><strong>Tahun Lulus : </strong><input type="text" name="tahun_lulus[]" class="yeargrade form-control tahunkeluar" placeholder="Tahun Lulus"></div></div><div class="mt-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger remove"><i class="fa fa-minus"></i></button></div></div>');
            });

            $("#addPelatihan").click(function(){
                i++;
                $('#tablePelatihan').append('<div class="row" id="removerow"><div class="col-xs-3 col-sm-3 col-md-6"><div class="form-group"><strong>Nama Pelatihan : </strong><input type="text" name="nama_pelatihan[]" class="form-control" placeholder="Masukkan Nama Pelatihan"></div></div><div class="col-xs-3 col-sm-3 col-md-6"><div class="form-group"><strong>Tahun Pelatihan : </strong><input type="text" name="tahun_pelatihan[]" class="yearskill form-control tahunpelatihan" placeholder="Tahun Pelatihan"></div></div><div class="col-xs-3 col-sm-3 col-md-12"><div class="form-group"><strong>Deskripsi Pelatihan : </strong><textarea type="text" class="form-control" name="deskripsi_pelatihan[]" id="deskpelatihan"rows="3" placeholder="Masukkan Deskripsi Pelatihan"></textarea></div></div><div class="col-xs-12 col-sm-12 col-md-12 text-right"><button type="button" name="remove" id="'+i+'" class="btn btn-danger remove"><i class="fa fa-minus"></i></button></div></div>');
            });

            $('#tingkatpendidikan').on('change', function() {
                var tingkat = $(this).val();
                console.log(tingkat);
            })

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $(document).on('click', '.date', function(){
                $(this).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true
                }).focus();
            });

            $(document).on('click', '.yeargrade', function(){
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years"
                }).focus();
            });

            $(document).on('click', '.yearskill', function(){
                $(this).datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    changeYear: true,
                    minViewMode: "years",
                }).focus();
            });

            $(document).on('changeDate', '.tanggalmasuk', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                $(".tanggalkeluar").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    setStartDate: startDate
                });
                    if($(".tanggalmasuk").val() > $(".tanggalkeluar").val()){
                $(".tanggalkeluar").val($(".tanggalmasuk").val());
                }
            });

            $(document).on('changeDate', '.tahunmasuk', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                $(".tahunkeluar").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    setStartDate: startDate.getFullYear()
                });
                    if($(".tahunmasuk").val() > $(".tahunkeluar").val()){
                        $(".tahunkeluar").val($(".tahunmasuk").val());
                }
            });

            $(document).on('click', '.remove', function(){
                var button_id = $(this).attr("id");
                $(this).parents('#removerow').remove();
            });

            $('select[name="indonesia_provinces"]').on('change',function(){
               var provinsiID = $(this).val();
               console.log(provinsiID);
               if(provinsiID)
               {
                  $.ajax({
                    url : "{{ route('pencari.kota') }}",
                    type : "POST",
                    data: {
                        provinsi_id: provinsiID
                    },
                    headers: {
                        "X-CSRF-Token": $("input[name='_token']").val()
                    },
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
                     url : "{{ route('pencari.kecamatan') }}",
                     type : "POST",
                     data: {
                        kota_id: kotaID
                     },
                     headers: {
                        "X-CSRF-Token": $("input[name='_token']").val()
                     },
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
               var kecamatanID = $(this).val();
               console.log(kecamatanID);
               if(kecamatanID)
               {
                  $.ajax({
                     url : "{{ route('pencari.kelurahan') }}",
                     type : "POST",
                     data: {
                        kecamatan_id: kecamatanID
                     },
                     headers: {
                        "X-CSRF-Token": $("input[name='_token']").val()
                     },
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
