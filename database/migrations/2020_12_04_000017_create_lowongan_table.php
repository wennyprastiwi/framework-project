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
            $table->string('nama_pekerjaan',100);
            $table->foreignId('id_penyedia_kerja')->constrained('penyedia_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('gaji')->unsigned();
            $table->date('tanggal_dibuka');
            $table->date('tanggal_ditutup');
            $table->text('deskripsi_pekerjaan');
            $table->string('kualifikasi');
            $table->text('gambaran_perusahaan');
            $table->string('keahlian_dibutuhkan');
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
