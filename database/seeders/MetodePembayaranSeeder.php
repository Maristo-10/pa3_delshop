<?php

namespace Database\Seeders;

use App\Models\MetodePembayaran;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //     protected $fillable = ['id','layanan','no_layanan','nama_pemilik','kategori_layanan','kapem'];
        $paymentMethods = [
            [
                'layanan' => 'Dana',
                'no_layanan' => '082277319005',
                'nama_pemilik' => 'Septian',
                'kategori_layanan' => 1,
                'kapem' => 'e-wallet'
            ],
            [
                'layanan' => 'BNI',
                'no_layanan' => '0088888888',
                'nama_pemilik' => 'Faraday',
                'kategori_layanan' => 2,
                'kapem' => 'transfer-bank'
            ]
        ];

        foreach($paymentMethods as $paymentMethod) {
            MetodePembayaran::create($paymentMethod);
        }
    }
}
