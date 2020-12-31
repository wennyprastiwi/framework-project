<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_lowongan', function (Blueprint $table) {
            $table->id();
            $table->char('id_lokasi', 4);
            $table->foreignId('id_lowongan')->constrained('lowongan')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

            $table->foreign('id_lokasi')
                ->references('id')
                ->on('indonesia_cities')
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
        Schema::dropIfExists('lokasi_lowongan');
    }
}
