<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi',100);
            $table->char('id_provinsi', 2);
            $table->char('id_kota', 4);
            $table->char('id_kecamatan', 7);
            $table->char('id_kelurahan', 10);
            $table->timestamps();

            $table->foreign('id_provinsi')
                ->references('id')
                ->on('indonesia_provinces')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_kota')
                ->references('id')
                ->on('indonesia_cities')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_kecamatan')
                ->references('id')
                ->on('indonesia_districts')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_kelurahan')
                ->references('id')
                ->on('indonesia_villages')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi');
    }
}
