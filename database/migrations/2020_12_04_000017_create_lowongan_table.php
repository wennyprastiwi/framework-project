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
            $table->foreignId('id_kategori')->constrained('kategori_pekerjaan')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_pekerjaan',100);
            $table->foreignId('id_lokasi')->constrained('lokasi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_penyedia_kerja')->constrained('penyedia_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('gaji')->unsigned();
            $table->date('tanggal_dibuka');
            $table->date('tanggal_ditutup');
            $table->text('deskripsi_pekerjaan');
            $table->text('kualifikasi');
            $table->text('gambaran_perusahaan');
            $table->text('keahlian_dibutuhkan');
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
