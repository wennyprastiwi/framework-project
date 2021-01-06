@extends('layouts.pencari_layout')

@section('title')
    Pencari Panel
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Biodata</h1>
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
                                <input type="hidden" value={{ $pencari->id }} name="id">
                            </div>
                            <div class="form-group">
                                <strong>Nama lengkap : </strong>
                                <input type="text" value="{{ $pencari->nama_lengkap }}" name="nama_lengkap"
                                    class="form-control" placeholder="Masukkan Nama lengkap" disabled>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>NIK : </strong>
                                <input value="{{ $pencari->nik }}" type="text" name="nik" class="form-control"
                                    placeholder="Masukkan NIK " disabled>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <strong for="exampleFormControlSelect1">Tempat lahir</strong>
                            <select name="tempat_lahir" class="form-control" id="tempatlahir" disabled>
                                @foreach ($kota as $tmplhr)
                                @php
                                $selected = "";
                                if ($tmplhr->name == $pencari->tempat_lahir) {
                                $selected = "selected='selected'";
                                }
                                @endphp
                                <option {{ $selected }} value="{{ $tmplhr->name }}">{{ $tmplhr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Tanggal lahir : </strong>
                                <input value="{{ $pencari->tanggal_lahir }}" type="text" name="tanggal_lahir"
                                    class="date form-control" id="tanggallahir" placeholder="Masukkan Tanggal lahir" disabled>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                            <strong for="exampleFormControlSelect1">Agama</strong>
                            <select name="agama" class="form-control" id="agama" disabled>
                                <option value="">-- Plih Agama --</option>
                                @foreach ($agama as $agm)
                                @php
                                $selected = "";
                                if ($agm->id == $pencari->agama) {
                                $selected = "selected='selected'";
                                }
                                @endphp
                                <option {{ $selected }} value="{{ $agm->id }}">{{ $agm->nama_agama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                            <strong for="exampleFormControlSelect1">Jenis Kelamin</strong>
                            <select name="jenis_kelamin" class="form-control" id="jeniskelamin" disabled>
                                <option value="">-- Plih Jenis Kelamin --</option>
                                <option value="1" {{ $pencari->jenis_kelamin == 1 ? 'selected' : '' }}>Laki - Laki
                                </option>
                                <option value="2" {{ $pencari->jenis_kelamin == 2 ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Alamat : </strong>
                                <input value="{{ $pencari->lokasi->nama_lokasi }}" type="text"
                                    name="alamat_pencari" class="form-control" placeholder="Masukkan Alamat Lengkap" disabled>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong for="exampleFormControlSelect1" id="provinsi">Provinsi</strong>
                            <select name="indonesia_provinces" class="form-control" id="provinsi" disabled>
                                @foreach ($provinsi as $prov)
                                @php
                                $selected = "";
                                if ($prov->id == $pencari->lokasi->provinsi->id) {
                                $selected = "selected='selected'";
                                }
                                @endphp
                                <option {{ $selected }} value="{{ $prov->id }}">{{ $prov->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong for="exampleFormControlSelect2" id="kota">Kota/Kabupaten</strong>
                            <select name="indonesia_cities" class="form-control" id="kota" disabled>
                                <option value="">-- Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong for="exampleFormControlSelect3">Kecamatan</strong>
                            <select name="indonesia_districts" class="form-control" id="kelurahan" disabled>
                                <option value="">-- Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong for="exampleFormControlSelect4">Kelurahan</strong>
                            <select name="indonesia_villages" class="form-control" id="kecamatan" disabled>
                                <option value="">-- Pilih Kelurahan</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <strong for="exampleFormControlSelect1">Status Pernikahan</strong>
                            <select name="status_pernikahan" class="form-control" id="statuspernikahan" disabled>
                                <option value="">-- Plih Status Pernikahan --</option>
                                <option value="Menikah"
                                    {{ $pencari->status_pernikahan == "Menikah" ? 'selected' : '' }}>Menikah
                                </option>
                                <option value="Lajang"
                                    {{ $pencari->status_pernikahan == "Lajang" ? 'selected' : '' }}>Lajang</option>
                                <option value="Cerai"
                                    {{ $pencari->status_pernikahan == "Cerai" ? 'selected' : '' }}>Cerai</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <strong>CV : </strong><br>
                            @if (!empty($pencari->file_cv))
                            <button type="button" class="btn btn-secondary">
                                <a class="text-white" download={{$pencari->file_cv}} href="{{ Storage::url('public/cv_pencari/'.$pencari->file_cv) }}">
                                    Download NPWP
                                </a>
                            </button>
                            @else
                                "File Tidak Ada"
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tablePekerjaan">
                    @if ($biodataPeker != NULL)
                    @forelse ($biodataPeker as $valPeker)
                    <div class="row mt-3">
                        <div class="col-xs-3 col-sm-3 col-md-4">
                            <div class="form-group">
                                <strong>Nama Pekerjaan : </strong>
                                <input type="text" name="nama_pekerjaan[]" class="form-control" value="{{ $valPeker->nama_pekerjaan }} "
                                    placeholder="Masukkan Nama Pekerjaan " disabled>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Lokasi Pekerjaan : </strong>
                                <select name="lokasi_kerja[]" class="form-control" id="lokasikerja" disabled>
                                    @foreach ($kota as $tmplhr)
                                    @php
                                    $selected = "";
                                    if ($tmplhr->name == $valPeker->lokasi_kerja) {
                                    $selected = "selected='selected'";
                                    }
                                    @endphp
                                    <option {{ $selected }} value="{{ $tmplhr->name }}">{{ $tmplhr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Tanggal Masuk : </strong>
                                <input type="text" name="tanggal_masuk[]" class="date form-control tanggalmasuk" value="{{ $valPeker->tanggal_masuk }}"
                                    placeholder="Tanggal masuk" disabled>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Tanggal keluar : </strong>
                                <input type="text" name="tanggal_keluar[]" class="date form-control tanggalkeluar" value="{{ $valPeker->tanggal_keluar }}"
                                    placeholder="Tanggal keluar" disabled>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="row mt-3">
                        <div class="mt-2 ml-4">
                            Data Tidak Ada
                        </div>
                    </div>
                    @endforelse
                    @endif
                </div>
                <div class="tab-pane fade" id="tablePendidikan">
                    @if ($biodataPend != NULL)
                    @forelse ($biodataPend as $valPend)
                    <div class="row mt-3">
                        <div class="col-xs-3 col-sm-3 col-md-4">
                            <div class="form-group">
                                <strong>Nama Instansi / Lembaga : </strong>
                                <input value="{{ $valPend->nama_instansi }}" type="text" name="nama_instansi[]"
                                    class="form-control" placeholder="Masukkan Nama Instansi / Lembaga " disabled>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Tingkat Pendidikan : </strong>
                                <select name="tingkat_pendidikan[]" class="form-control" id="tingkatpendidikan" disabled>
                                    @foreach ($jnsPendidikan as $tingkatpen)
                                    @php
                                    $selected = "";
                                    if ($tingkatpen->id == $valPend->pendidikan_terakhir) {
                                    $selected = "selected='selected'";
                                    }
                                    @endphp
                                    <option {{ $selected }} value="{{ $tingkatpen->id }}">
                                        {{ $tingkatpen->nama_jenis_pendidikan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Tahun Masuk : </strong>
                                <input value="{{ $valPend->tahun_masuk }}" type="text" name="tahun_masuk[]"
                                    class="yeargrade form-control tahunmasuk" placeholder="Tahun Masuk" disabled>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Tahun Lulus : </strong>
                                <input value="{{ $valPend->tahun_lulus }}" type="text" name="tahun_lulus[]"
                                    class="yeargrade form-control tahunkeluar" placeholder="Tahun Lulus" disabled>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="row mt-3">
                        <div class="mt-2 ml-4">
                            Data Tidak Ada
                        </div>
                    </div>
                    @endforelse
                    @endif
                </div>
                <div class="tab-pane fade" id="tablePelatihan">
                    @if ($biodataPel != NULL)
                    @forelse ($biodataPel as $valPel)
                    <div class="row mt-3">
                        <div class="col-xs-3 col-sm-3 col-md-6">
                            <div class="form-group">
                                <strong>Nama Pelatihan : </strong>
                                <input type="text" name="nama_pelatihan[]" class="form-control" value="{{ $valPel->nama_pelatihan }}"
                                    placeholder="Masukkan Nama Pelatihan " disabled>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-6">
                            <div class="form-group">
                                <strong>Tahun Pelatihan : </strong>
                                <input type="text" name="tahun_pelatihan[]" value="{{ $valPel->tahun_pelatihan }}"
                                    class="yearskill form-control tahunpelatihan" placeholder="Tahun Pelatihan" disabled>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-12">
                            <div class="form-group">
                                <strong>Deskripsi Pelatihan : </strong>
                                <textarea type="text" class="form-control" name="deskripsi_pelatihan[]" disabled
                                    id="deskpelatihan" rows="3" placeholder="Masukkan Deskripsi Pelatihan">{{ $valPel->deskripsi_singkat }}</textarea>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="row mt-3">
                        <div class="mt-2 ml-4">
                            Data Tidak Ada
                        </div>
                    </div>
                    @endforelse
                    @endif
                </div>
            </div>
    </div>
</div>

@endsection
@section('pagejs')
<script>
    $(document).ready(function ()
    {
            const getKota = (provinsiID, callback) => {
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
                    callback(data)
                }
            });
        }

        const setKota = () => {
            let provinsiID = "{{ $pencari->lokasi->id_provinsi }}";
            getKota(provinsiID, data => {
                console.log(data);
                $('select[name="indonesia_cities"]').empty();
                $.each(data, function(key,value){
                    $('select[name="indonesia_cities"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            })
        }
        setKota();

        $('select[name="indonesia_provinces"]').on('change',function(){
            var provinsiID = $(this).val();
            console.log(provinsiID);
            if(provinsiID)
            {
                getKota(provinsiID, (data) => {
                    console.log(data);
                    $('select[name="indonesia_cities"]').empty();
                    $.each(data, function(key,value){
                        $('select[name="indonesia_cities"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                })
            }
            else
            {
                $('select[name="indonesia_cities"]').empty();
            }
        });

        const getKecamatan = (kotaID, callback) => {
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
                    callback(data)
                }
            });
        }

        const setKecamatan = () => {
            let kotaID = "{{ $pencari->lokasi->id_kota }}";
            getKecamatan(kotaID, data => {
                console.log(data);
                $('select[name="indonesia_districts"]').empty();
                $.each(data, function(key,value){
                    $('select[name="indonesia_districts"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            })
        }
        setKecamatan();

        $('select[name="indonesia_cities"]').on('change',function(){
            var kotaID = $(this).val();
            console.log(kotaID);
            if(kotaID)
            {
               getKecamatan(kotaID, (data) => {
                    console.log(data);
                    $('select[name="indonesia_districts"]').empty();
                    $.each(data, function(key,value){
                        $('select[name="indonesia_districts"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                })
            }
            else
            {
                $('select[name="indonesia_districts"]').empty();
            }
        });

        const getKelurahan = (kecamatanID, callback) => {
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
                    callback(data)
                }
            });
        }

        const setKelurahan = () => {
            let kecamatanID = "{{ $pencari->lokasi->id_kecamatan }}";
            getKelurahan(kecamatanID, data => {
                console.log(data);
                $('select[name="indonesia_villages"]').empty();
                $.each(data, function(key,value){
                    $('select[name="indonesia_villages"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            })
        }
        setKelurahan();

        $('select[name="indonesia_districts"]').on('change',function(){
            var kecamatanID = $(this).val();
            console.log(kecamatanID);
            if(kecamatanID)
            {
               getKelurahan(kecamatanID, (data) => {
                    console.log(data);
                    $('select[name="indonesia_villages"]').empty();
                    $.each(data, function(key,value){
                        $('select[name="indonesia_villages"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                })
            }
            else
            {
                $('select[name="indonesia_villages"]').empty();
            }
        });
    });
</script>
@endsection
