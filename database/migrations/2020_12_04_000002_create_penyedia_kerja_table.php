<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyediaKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyedia_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan',200);
            $table->string('alamat_web');
            $table->longText('deskripsi_perusahaan');
            $table->string('logo_perusahaan');
            $table->string('status_perusahaan', 2);
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
        Schema::dropIfExists('penyedia_kerja');
    }
}
