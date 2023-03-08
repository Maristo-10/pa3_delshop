<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id("id_produk");
            $table->string('gambar_produk')->nullable();
            $table->string("nama_produk");
            $table->double("harga");
            $table->double("jumlah_produk");
            $table->longText("deskripsi");
            // $table->string('ukuran')->nullable();
            $table->string("status_produk")->default("Aktif");
            $table->string("produk_unggulan")->default("Non-Unggulan");
            $table->timestamps();

            $table->string("role_pembeli");
            $table->string("kategori_produk");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
