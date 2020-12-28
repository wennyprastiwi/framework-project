<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataPendidikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pencari_kerja')->constrained('pencari_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_instansi', 255);
            $table->integer('pendidikan_terakhir')->unsigned();
            $table->year('tahun_masuk');
            $table->year('tahun_lulus');
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
        Schema::dropIfExists('biodata_pendidikan');
    }
}
