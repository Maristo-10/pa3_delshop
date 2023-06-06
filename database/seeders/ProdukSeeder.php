<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'gambar_produk' => 'pin.png',
                'nama_produk' => 'Pin IT Del',
                'harga' => 10000,
                'jumlah_produk' => 10,
                'deskripsi' => 'Ini deskripsi pin it del',
                'role_pembeli' => 'Mahasiswa',
                'kategori_produk' => 'Pin'
            ],
            [
                'gambar_produk' => 'baju_putih.png',
                'nama_produk' => 'Baju Putih IT Del',
                'harga' => 12000,
                'jumlah_produk' => 16,
                'deskripsi' => 'Ini deskripsi baju putih it del',
                'role_pembeli' => 'Mahasiswa',
                'kategori_produk' => 'Baju'
            ]
        ];
        foreach($products as $product) {
            Produk::create($product);
        }
    }
}
