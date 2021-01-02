@extends('layouts.back-end_layout')

@section('title')
Edit Lowongan
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Lowongan</h1>
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

        <form action="{{ route('lowongan.update') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="hidden" value={{ $lowongan->id }} name="id">
                    </div>
                    <div class="form-group">
                        <strong>Nama Pekerjaan: </strong>
                        <input type="text" name="nama_pekerjaan" class="form-control"
                            placeholder="Masukkan Nama Pekerjaan" value="{{ $lowongan->nama_pekerjaan }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        @php
                            $ktgLok = [];
                            foreach ($ktgLoker as $valLok) {
                                $ktgLok[] = $valLok->id_kategori_pekerjaan;
                            }
                        @endphp
                        <strong>kategori Lowongan : </strong>
                        <select name="kategori_lowongan[]" class="form-control" id="kategorilowongan"
                            multiple="multiple" required>
                            @foreach ($ktgPekerjaan as $ktg)
                                <option value="{{ $ktg->id }}"
                                    @php echo in_array($ktg->id, $ktgLok) ? 'selected': '' @endphp
                                >
                                    {{ $ktg->nama_kategori_pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    @php
                    $lokasiLok = [];
                        foreach ($lokasiLoker as $valLok) {
                        $lokasiLok[] = $valLok->id_lokasi;
                    }
                    @endphp
                    <strong for="exampleFormControlSelect1">Kota Penempatan</strong>
                    <select name="kota_penempatan[]" class="form-control" id="kota" multiple="multiple"
                        placeholder="Masukkan Kota Lowongan">
                        @foreach ($kota as $kot)
                        <option value="{{ $kot->id }}" @php echo in_array($kot->id, $lokasiLok) ? 'selected': '' @endphp
                            >
                            {{ $kot->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <div class="form-group">
                        <strong>Gaji : </strong><i class="fas fa-question fa-sm" data-toggle="tooltip"
                            title="Isi '0' jika tidak disebutkan " style="color: Tomato;"></i>
                        <input type="text" name="gaji" id="rupiah" class="form-control"
                            placeholder="Masukkan Alamat Gaji" value="{{ 'Rp. '. number_format($lowongan->gaji,0, ".", ".") }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <div class="form-group">
                        <strong>Tanggal Dibuka : </strong>
                        <input type="text" name="tanggal_dibuka" class="date form-control" id="tanggaldibuka"
                            value="{{ $lowongan->tanggal_dibuka }}" placeholder="Tanggal Dibuka">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <div class="form-group">
                        <strong>Tanggal Ditutup : </strong>
                        <input type="text" name="tanggal_ditutup" class="date form-control" id="tanggalditutup"
                            value="{{ $lowongan->tanggal_ditutup }}" placeholder="Tanggal Ditutup">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Deskripsi Pekerjaan : </strong>
                        <textarea type="text" class="form-control" name="deskripsi_pekerjaan" id="deskripsi_pekerjaan"
                            rows="5" placeholder="Masukkan Deskripsi Pekerjaan"
                             required> {{ $lowongan->deskripsi_pekerjaan }} </textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Gambaran Perusahaan : </strong>
                        <textarea type="text" class="form-control" name="gambaran_perusahaan" id="gambaran_perusahaan"
                            rows="5" placeholder="Masukkan Gambaran Perusahaan"
                             required> {{ $lowongan->gambaran_perusahaan }} </textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <div class="form-group" id="kualifikasiEditArea">
                        <label for="kualifikasi">Kualifikasi :</label>
                        <input type="hidden" name="kualifikasi" id="kualifikasi_add">
                        <div class="area">
                            @php
                            $i = 0;
                            @endphp
                            @foreach (json_decode($lowongan->kualifikasi) as $kua)
                            @php
                            $iPP = $i++;
                            @endphp
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="edit_kua{{ $iPP }}" name="kualifikasi[]"
                                    oninput="addKuaEdit(this)" value="{{ $kua }}">
                                <span class="btn btn-danger ml-1 text-white transparent" id="removeBtnkualifikasi{{ $iPP }}"
                                    aria-hidden="true" onclick="removeKuaEdit('{{ $iPP }}', '{{ $kua }}')"><i
                                        class="fas fa-times text-right"></i></span>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="moreKuaEdit()" id="moreKuaEditBtn"
                            class="btn btn-secondary mr-8 mt-2"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="form-group" id="skillEditArea">
                        <label for="skill">Skill :</label>
                        <input type="hidden" name="skill" id="skill_add">
                        <div class="area">
                            @php
                            $a = 0;
                            @endphp
                            @foreach (json_decode($lowongan->keahlian_dibutuhkan) as $skill)
                            @php
                            $aPP = $a++;
                            @endphp
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="edit_skill{{ $iPP }}" name="skill[]"
                                    oninput="addSkillEdit(this)" value="{{ $skill }}">
                                <span class="btn btn-danger ml-1 text-white transparent" id="removeBtnSkill{{ $iPP }}"
                                    aria-hidden="true" onclick="removeSkillEdit('{{ $iPP }}', '{{ $skill }}')"><i
                                        class="fas fa-times"></i></span>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="moreSkillEdit()" id="moreSkillEditBtn"
                            class="btn btn-secondary mt-2 text-right"><i class="fas fa-plus"></i></button>
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
            skill: {!! $lowongan->keahlian_dibutuhkan !!},
            kualifikasi: {!! $lowongan->kualifikasi !!}
        },
        store: {
            skill: [],
            kualifikasi: []
        }
    }

    const addKuaEdit = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['edit']['kualifikasi'][index] = value
        select("#kualifikasi_edit").value = JSON.stringify(state['edit']['kualifikasi'])

        if (index == 0) {
            let buttonVisibility = value != "" ? "block" : "none"
            select("button#moreKuaEditBtn").style.display = buttonVisibility
        }
    }
    const moreKuaEdit = () => {
        let index = state['edit']['kualifikasi'].length
        console.log(state['edit'])
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group'],
                ['id', `edit_kua${index}`]
            ],
            html: `<input type="text" class="form-control" id="kualifikasi_${index}" name="kualifikasi[]" oninput="addKuaEdit(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removeKuaEdit('${index}')"><i class="fas fa-times"></i></span>`,
            createTo: '#kualifikasiEditArea .area'
        })
    }

    const removeKuaEdit = (index, kualifikasi = null) => {
        if (kualifikasi == null) {
            select(`#edit_kua${index}`).remove()
            select(`#removeBtnkualifikasi${index}`).remove()
            state['edit']['kualifikasi'].splice(index, 1)
        }else {
            let i = 0
            state.edit.kualifikasi.forEach(sk => {
                let iPP = i++
                if (kualifikasi == sk) {
                    state['edit']['kualifikasi'].splice(iPP, 1)
                    select(`#edit_kua${iPP}`).remove()
                    select(`#removeBtnkualifikasi${iPP}`).remove()
                }
            })
        }
        select("#kualifikasi_edit").value = JSON.stringify(state['edit']['kualifikasi'])
    }

    const addSkillEdit = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['edit']['skill'][index] = value
        select("#skill_edit").value = JSON.stringify(state['edit']['skill'])
    }
    const moreSkillEdit = () => {
        let index = state['edit']['skill'].length
        console.log(state['edit'])
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `edit_skill${index}`]
            ],
            html: `<input type="text" class="form-control" name="skill[]" id="skill_${index}" oninput="addSkillEdit(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removeSkillEdit(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#skillEditArea .area'
        })
    }

    const removeSkillEdit = (index, skill = null) => {
        if (skill == null) {
            select(`#edit_skill${index}`).remove()
            select(`#removeBtnskill${index}`).remove()
            state['edit']['skill'].splice(index, 1)
        }else {
            let i = 0
            state.edit.skill.forEach(sk => {
                let iPP = i++
                if (skill == sk) {
                    state['edit']['skill'].splice(iPP, 1)
                    select(`#edit_skill${iPP}`).remove()
                    select(`#removeBtnSkill${iPP}`).remove()
                }
            })
        }
        select("#skill_edit").value = JSON.stringify(state['edit']['skill'])
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
