<?php

namespace Database\Seeders;

use App\Models\KategoriPembayaran;
use Illuminate\Database\Seeder;

class KategoriPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //     protected $fillable =['id','kategori_pembayaran'];

        $categoryPayments = [
            [
                'kategori_pembayaran' => 'E-wallet'
            ],
            [
                'kategori_pembayaran' => 'Transfer Bank'
            ],

        ];
        foreach($categoryPayments as $categoryPayment) {
            KategoriPembayaran::create($categoryPayment);
        }
    }
}
