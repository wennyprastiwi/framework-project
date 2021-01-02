@extends('layouts.perusahaan_layout')

@section('title')
Perusahaan - Buat Lowongan
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Lowongan</h1>
    <a href="{{ route('perusahaan.lowongan') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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

        <form action="{{ route('perusahaan.lowongan.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Pekerjaan: </strong>
                        <input type="text" name="nama_pekerjaan" class="form-control"
                            placeholder="Masukkan Nama Pekerjaan" value="{{ old('nama_pekerjaan') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Kategori Lowongan : </strong>
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
                    <strong for="exampleFormControlSelect1">Kota Penempatan</strong>
                    <select name="kota_penempatan[]" class="form-control" id="kota" multiple="multiple" placeholder="Masukkan Kota Lowongan">
                        <option value="">-- Plih Kota / Kabupaten --</option>
                        @foreach ($kota as $kot)
                        <option value="{{ $kot->id }}">{{ $kot->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <div class="form-group">
                        <strong>Gaji : </strong><i class="fas fa-question fa-sm" data-toggle="tooltip"
                        title="Isi '0' jika tidak disebutkan " style="color: Tomato;"></i>
                        <input type="text" name="gaji" id="rupiah" class="form-control" placeholder="Masukkan Alamat Gaji"
                            value="{{ old('gaji') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <div class="form-group">
                        <strong>Tanggal Dibuka : </strong>
                        <input type="text" name="tanggal_dibuka" class="date form-control" id="tanggaldibuka"
                            value="{{ old('tanggal_dibuka') }}" placeholder="Tanggal Dibuka">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <div class="form-group">
                        <strong>Tanggal Ditutup : </strong>
                        <input type="text" name="tanggal_ditutup" class="date form-control" id="tanggalditutup"
                            value="{{ old('tanggal_ditutup') }}" placeholder="Tanggal Ditutup">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Deskripsi Pekerjaan : </strong>
                        <textarea type="text" class="form-control" name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" rows="5"
                            placeholder="Masukkan Deskripsi Pekerjaan" value="{{ old('deskripsi_pekerjaan') }}"
                            required></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Gambaran Perusahaan : </strong>
                        <textarea type="text" class="form-control" name="gambaran_perusahaan" id="gambaran_perusahaan" rows="5"
                            placeholder="Masukkan Gambaran Perusahaan" value="{{ old('gambaran_perusahaan') }}"
                            required></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <div class="form-group" id="kualifikasiAddArea">
                        <label for="kualifikasi">Kualifikasi :</label>
                        <input type="hidden" name="kualifikasi" id="kualifikasi_add">
                        <div class="area">
                            <div class="input-group">
                                <input type="text" class="form-control" id="kualifikasi_0" oninput="addKuaStore(this)">
                                <button type="button" onclick="moreKuaStore()" id="moreKuaStoreBtn" class="btn btn-secondary ml-2"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="skillAddArea">
                        <label for="skill">Skill :</label>
                        <input type="hidden" name="skill" id="skill_add">
                        <div class="area">
                            <div class="input-group">
                                <input type="text" class="form-control" id="skill_0" oninput="addSkillStore(this)">
                                <button type="button" id="moreSkillStoreBtn" class="btn btn-secondary ml-2" onclick="moreSkillStore()"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
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
<script src="{{ asset('js/base.js') }}"></script>
<script>

let state = {
        edit: {
            skill: [],
            kualifikasi: []
        },
        store: {
            skill: [],
            kualifikasi: []
        }
    }

    const addKuaStore = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['store']['kualifikasi'][index] = value
        select("#kualifikasi_add").value = JSON.stringify(state['store']['kualifikasi'])

        if (index == 0) {
            let buttonVisibility = value != "" ? "block" : "none"
            select("button#moreKuaStoreBtn").style.display = buttonVisibility
        }
    }
    const addSkillStore = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['store']['skill'][index] = value
        select("#skill_add").value = JSON.stringify(state['store']['skill'])

        if (index == 0) {
            let buttonVisibility = value != "" ? "block" : "none"
            select("button#moreSkillStoreBtn").style.display = buttonVisibility
        }
    }
    const moreKuaStore = () => {
        let index = state['store']['kualifikasi'].length
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `store_req${index}`]
            ],
            html: `<input type="text" class="form-control" id="kualifikasi_${index}" oninput="addKuaStore(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removeKuaStore(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#kualifikasiAddArea .area'
        })
    }
    const moreSkillStore = () => {
        let index = state['store']['skill'].length
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `store_skill${index}`]
            ],
            html: `<input type="text" class="form-control" id="skill_${index}" oninput="addSkillStore(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removeSkillStore(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#skillAddArea .area'
        })
    }
    const removeKuaStore = i => {
        select(`#store_req${i}`).remove()
        state['store']['kualifikasi'].splice(i, 1)
        select("#kualifikasi_add").value = JSON.stringify(state['store']['kualifikasi'])
    }
    const removeSkillStore = i => {
        select(`#store_skill${i}`).remove()
        state['store']['skill'].splice(i, 1)
        select("#skill_add").value = JSON.stringify(state['store']['skill'])
    }

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

        $(document).on('click', '.date', function(){
                $(this).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true
                }).focus();
            });

        $("#tanggaldibuka").on('changeDate', function(selected) {
            var startDate = new Date(selected.date.valueOf());
            $("#tanggalditutup").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    setStartDate: startDate
            });
            $("#tanggalditutup").datepicker('setStartDate', startDate);
            if($("#tanggaldibuka").val() > $("#tanggalditutup").val()){
                $("#tanggalditutup").val($("#tanggaldibuka").val());
            }
        });

        var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});

		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
    });


</script>
@endsection
