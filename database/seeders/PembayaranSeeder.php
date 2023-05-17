<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metodepembayarans')->insert([
            'id_metpem' => 901,
            'layanan' => 'Bayar Tunai',
            'no_layanan' => '-',
            'nama_pemilik' => 'Delshop',
            'kategori_layanan' => 901,
            'kapem' => 'Tunai'
        ]);
    }
}
