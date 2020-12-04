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
            $table->string('bidang_usaha',200);
            $table->foreignId('id_lokasi')->constrained('lokasi');
            $table->string('alamat_web');
            $table->foreignId('id_kontak')->constrained('kontak');
            $table->string('deskripsi_perusahaan',100);
            $table->foreignId('id_dokumen')->constrained('dokumen_perusahaan');
            $table->string('logo_perusahaan');
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
