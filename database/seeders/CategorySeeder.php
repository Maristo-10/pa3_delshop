<?php

namespace Database\Seeders;

use App\Models\KategoriProdukModel;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'kategori' => 'Pin',
                'gambar_kategori' => 'image.png'
            ],
            [
                'kategori' => 'Baju',
                'gambar_kategori' => 'baju.png'
            ]
        ];

        foreach($categories as $category) {
            KategoriProdukModel::create($category);
        }
    }
}
