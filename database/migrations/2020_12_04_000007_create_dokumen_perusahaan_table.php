<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penyedia_kerja')->constrained('penyedia_kerja')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('sop',100);
            $table->string('surat_domisili');
            $table->string('npwp',100);
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
        Schema::dropIfExists('dokumen_perusahaan');
    }
}
