<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataPelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pencari_kerja')->constrained('pencari_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_pelatihan', 200);
            $table->date('tahun_pelatihan');
            $table->text('deskripsi_pelatihan');
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
        Schema::dropIfExists('biodata_pelatihan');
    }
}
