<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('jenis_kelamin')->default('Laki-Laki');
            $table->string('pekerjaan')->default('-');
            $table->string('alamat')->default('-');
            $table->string('no_telp')->default('-');
            $table->string('gambar_pengguna')->default('profile.png');
            $table->longText('tentang')->nullable();
            $table->string('email')->unique();
            $table->string('twitter')->default('https://twitter.com/');
            $table->string('facebook')->default('https://facebook.com/');
            $table->string('instagram')->default('https://instagram.com/');
            $table->string('linkedin')->default('https://linkedin.com/');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string("role_pengguna")->default('Publik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
