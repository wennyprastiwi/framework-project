<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLamaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lowongan')->constrained('lowongan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pencari_kerja')->constrained('pencari_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->text('alasan');
            $table->integer('status_lamaran')->unsigned();
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
        Schema::dropIfExists('lamaran');
    }
}
