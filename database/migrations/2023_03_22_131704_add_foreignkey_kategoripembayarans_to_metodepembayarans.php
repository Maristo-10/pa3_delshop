<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyKategoripembayaransToMetodepembayarans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metodepembayarans', function (Blueprint $table) {
            $table->foreign("kategori_layanan")->references("id")->on("kategoripembayarans")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metodepembayarans', function (Blueprint $table) {
            //
        });
    }
}
