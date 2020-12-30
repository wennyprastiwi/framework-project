<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_lowongan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori_pekerjaan')->constrained('kategori_pekerjaan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_lowongan')->constrained('lowongan')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('kategori_lowongan');
    }
}
