<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Corousel;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $corousel = [
            [
                'gambar_corousel' => 'image.png',
                'status' => 1
            ],
            [
                'gambar_corousel' => 'image.png',
                'status' => 1
            ],
            [
                'gambar_corousel' => 'image.png',
                'status' => 1
            ]
        ];

        foreach($corousel as $corousels) {
            Corousel::create($corousels);
        }
    }
}
