<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ukuranproduks')->insert([
            'ukuran' => 'XS'
        ]);
        DB::table('ukuranproduks')->insert([
            'ukuran' => 'S'
        ]);
        DB::table('ukuranproduks')->insert([
            'ukuran' => 'M'
        ]);
        DB::table('ukuranproduks')->insert([
            'ukuran' => 'L'
        ]);
        DB::table('ukuranproduks')->insert([
            'ukuran' => 'XL'
        ]);

        
    }
}
