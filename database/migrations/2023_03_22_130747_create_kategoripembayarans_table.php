<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoripembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategoripembayarans', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id('id_kapem');
=======
            $table->increments('id_kapem');
>>>>>>> 61fd75ec57e53cf2462c08a9506408642b347e05
            $table->string('kategori_pembayaran');
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
        Schema::dropIfExists('kategoripembayarans');
    }
}
