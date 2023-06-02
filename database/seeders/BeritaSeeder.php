<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        $beritas = [
            [
                'title' => 'berita 1',
                'subtitle' => 'sub title 1',
                'image' => 'berita.png',
                'description' => 'ini description berita 1'
            ]
        ];

        foreach($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
