<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penyedia_kerja')->constrained('penyedia_kerja')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('no_hp',20);
            $table->string('email',100);
            $table->string('link_ig',100)->nullable();
            $table->string('link_twitter',100)->nullable();
            $table->string('link_linkedin',100)->nullable();
            $table->string('link_facebook',100)->nullable();
            $table->char('jenis_kontak', 2);
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
        Schema::dropIfExists('kontak');
    }
}
