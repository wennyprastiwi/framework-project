<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataPekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pencari_kerja')->constrained('pencari_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_pekerjaan', 100);
            $table->string('lokasi_kerja', 200);
            $table->time('tanggal_masuk');
            $table->time('tanggal_keluar');
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
        Schema::dropIfExists('biodata_pekerjaan');
    }
}
