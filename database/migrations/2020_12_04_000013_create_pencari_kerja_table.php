<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencariKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencari_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap',200);
            $table->string('nik',100);
            $table->string('tempat_lahir',50);
            $table->date('tanggal_lahir');
            $table->string('status_pernikahan',20);
            $table->foreignId('id_agama')->constrained('agama');
            $table->foreignId('id_lokasi')->constrained('lokasi');
            $table->foreignId('id_kontak')->constrained('kontak');
            $table->foreignId('id_pekerjaan')->constrained('biodata_pekerjaan');
            $table->foreignId('id_sertifikasi')->constrained('biodata_pelatihan');
            $table->foreignId('id_pendidikan')->constrained('biodata_pendidikan');
            $table->string('file_cv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pencari_kerja');
    }
}
