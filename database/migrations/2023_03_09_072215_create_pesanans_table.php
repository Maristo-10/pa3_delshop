<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id');
            $table->string('kode')->default("null");
            $table->date('tanggal');
            $table->integer('total_harga');
            $table->string('status')->default('keranjang');
            $table->string('nama_pengambil')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger("user_id");
            $table->unsignedInteger("nama_layanan")->nullable();
            $table->unsignedInteger("metode_pembayaran")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
