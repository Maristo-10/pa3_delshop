<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KapemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoripembayarans')->insert([
            'id_kapem' => 901,
            'kategori_pembayaran' => 'Tunai',
        ]);
    }
}
