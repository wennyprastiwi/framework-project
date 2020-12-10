<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidangPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidang_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori_pekerjaan')->constrained('kategori_pekerjaan');
            $table->foreignId('id_penyedia_kerja')->constrained('penyedia_kerja');
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
        Schema::dropIfExists('bidang_perusahaan');
    }
}
