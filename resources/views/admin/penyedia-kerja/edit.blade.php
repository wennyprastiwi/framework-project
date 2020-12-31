@extends('layouts.back-end_layout')

@section('title')
Master Kategori Pekerjaan
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Penyedia Kerja</h1>
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

        <form action="{{ route('penyediaKerja.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="hidden" value={{ $penyediaKerja->id }} name="id">
                    </div>
                    <div class="form-group">
                        <strong>Nama Perusahaan: </strong>
                        <input type="text" value={{ $penyediaKerja->nama_perusahaan }} name="nama_perusahaan"
                            class="form-control" placeholder="Masukkan Nama Perusahaan" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        @php
                            $bidPer = [];
                            foreach ($bidKerja as $valBid) {
                                $bidPer[] = $valBid->id_kategori_pekerjaan;
                            }
                        @endphp
                        <strong>Bidang Usaha: </strong>
                        <select name="bidang_usaha[]" class="form-control" id="bidangusaha"
                            multiple="multiple" required>
                            @foreach ($ktgPekerjaan as $ktg)
                                <option value="{{ $ktg->id }}"
                                    @php echo in_array($ktg->id, $bidPer) ? 'selected': '' @endphp
                                >
                                    {{ $ktg->nama_kategori_pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Alamat: </strong>
                        <input type="text" value="{{ $penyediaKerja->lokasi->nama_lokasi }}" name="alamat_perusahaan"
                            class="form-control" placeholder="Masukkan Alamat Perusahaan" required>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <strong for="exampleFormControlSelect1" id="provinsi">Provinsi</strong>
                    <select name="indonesia_provinces" class="form-control" id="provinsi">
                        @foreach ($provinsi as $prov)
                        @php
                            $selected = "";
                                if ($prov->id == $penyediaKerja->lokasi->id_provinsi) {
                                $selected = "selected='selected'";
                            }
                        @endphp
                        <option {{ $selected }} value="{{ $prov->id }}">{{ $prov->name }}</option>
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
                    <div class="form-group">
                        <strong>Website: </strong>
                        <input type="text"  value="{{ $penyediaKerja->alamat_web }}" name="alamat_web" class="form-control" placeholder="Masukkan Alamat Website"
                            required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email: </strong>
                        <input type="text" value="{{ $penyediaKerja->kontak->email }}" name="email" class="form-control"
                            placeholder="Masukkan Email" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No Telepon: </strong>
                        <input type="text" value="{{ $penyediaKerja->kontak->no_hp }}" name="no_hp" class="form-control"
                            placeholder="Masukkan No Telp" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Deskripsi: </strong>
                        <textarea type="text" class="form-control" name="deskripsi_perusahaan" id="address" rows="5"
                            placeholder="Masukkan Deskripsi Perusahaan">{{ $penyediaKerja->deskripsi_perusahaan }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>SOP : </strong><i class="fas fa-question fa-sm" data-toggle="tooltip"
                        title="Kosongi jika tidak update" style="color: Tomato;"></i>
                    <div class="custom-file">
                        <input name="sop" type="file" class="custom-file-input" id="sop" accept=".pdf,.docx">
                        <label class="custom-file-label" for="sop">Choose file</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>Surat Domisili : </strong><i class="fas fa-question fa-sm" data-toggle="tooltip"
                        title="Kosongi jika tidak update" style="color: Tomato;"></i>
                    <div class="custom-file">
                        <input name="surat_domisili" type="file" class="custom-file-input" id="surat_domisili"
                            accept=".pdf,.docx">
                        <label class="custom-file-label" for="surat_domisili">Choose file</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>NPWP : </strong><i class="fas fa-question fa-sm" data-toggle="tooltip"
                        title="Kosongi jika tidak update" style="color: Tomato;"></i>
                    <div class="custom-file">
                        <input name="npwp" type="file" class="custom-file-input" id="npwp" accept=".pdf,.docx">
                        <label class="custom-file-label" for="npwp">Choose file</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <strong>Logo : </strong><i class="fas fa-question fa-sm" data-toggle="tooltip"
                        title="Kosongi jika tidak update" style="color: Tomato;"></i>
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
    $(document).ready(function ()
    {
        $('[data-toggle="tooltip"]').tooltip();
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#bidangusaha').select2();

        $('#bidangusaha').on('change', function() {
            var bidangUsaha = $(this).val();
            console.log(bidangUsaha);
        });

         const getKota = (provinsiID, callback) => {
            $.ajax({
                url : "{{ route('penyediaKerja.kota') }}",
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

        const setKota = (idKota) => {
            let provinsiID = "{{ $penyediaKerja->lokasi->id_provinsi }}";
            getKota(provinsiID, data => {
                console.log(data);
                $('select[name="indonesia_cities"]').empty();
                $.each(data, function(key,value){
                    $('select[name="indonesia_cities"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
                if(typeof idKota !== 'undefined')  $('select[name="indonesia_cities"] option[value="' + idKota + '"]').attr('selected','selected');
            })
        }
        setKota('{{ $penyediaKerja->lokasi->kota->id }}');

        $('select[name="indonesia_provinces"]').on('change',function(){
            var provinsiID = $(this).val();
            console.log(provinsiID);
            if(provinsiID)
            {
                getKota(provinsiID, (data) => {
                    console.log(data);
                    $('select[name="indonesia_cities"]');
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
                url : "{{ route('penyediaKerja.kecamatan') }}",
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

         const setKecamatan = (idKecamatan) => {
            let kotaID = "{{ $penyediaKerja->lokasi->id_kota }}";
            getKecamatan(kotaID, data => {
                console.log(data);
                $('select[name="indonesia_districts"]').empty();
                $.each(data, function(key,value){
                    $('select[name="indonesia_districts"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
                if(typeof idKecamatan !== 'undefined')  $('select[name="indonesia_districts"] option[value="' + idKecamatan + '"]').attr('selected','selected');
            })
        }
        setKecamatan('{{ $penyediaKerja->lokasi->kecamatan->id }}');

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
                url : "{{ route('penyediaKerja.kelurahan') }}",
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

        const setKelurahan = (idKelurahan) => {
            let kecamatanID = "{{ $penyediaKerja->lokasi->id_kecamatan }}";
            getKelurahan(kecamatanID, data => {
                console.log(data);
                $('select[name="indonesia_villages"]').empty();
                $.each(data, function(key,value){
                    $('select[name="indonesia_villages"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
                if(typeof idKelurahan !== 'undefined')  $('select[name="indonesia_villages"] option[value="' + idKelurahan + '"]').attr('selected','selected');
            })
        }
        setKelurahan('{{ $penyediaKerja->lokasi->kelurahan->id }}');

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
