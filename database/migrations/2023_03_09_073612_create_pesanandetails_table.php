<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanandetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanandetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->timestamps();

            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('pesanan_id');
            $table->string("ukurans")->nullable();
            $table->string("warna_produk")->nullable();
            $table->string("angkatans")->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanandetails');
    }
}
