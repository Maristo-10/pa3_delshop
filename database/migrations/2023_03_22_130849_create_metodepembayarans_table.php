<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodepembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodepembayarans', function (Blueprint $table) {
            $table->increments('id_metpem');
            $table->string('nama_layanan');
            $table->string('no_layanan');
            $table->string('nama_pemilik');
            $table->unsignedInteger('kategori_layanan');
            $table->string('kapem')->nullable();
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
        Schema::dropIfExists('metodepembayarans');
    }
}
