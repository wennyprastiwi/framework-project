<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori_pekerjaan');
            $table->string('nama_pekerjaan',100);
            $table->string('jenis_pekerjaan',50);
            $table->foreignId('id_lokasi')->constrained('lokasi');
            $table->foreignId('id_pekerjaan')->constrained('kontak');
            $table->Integer('gaji');
            $table->date('tanggal_dibuka');
            $table->date('tanggal_ditutup');
            $table->string('deskripsi_pekerjaan');
            $table->string('kualifikasi', 200);
            $table->string('gambaran_perusahaan', 200);
            $table->string('keahlian_dibutuhkan', 200);
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
        Schema::dropIfExists('lowongan');
    }
}
