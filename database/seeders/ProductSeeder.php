<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'quantity' => 20,
        ]);
        DB::table('products')->insert([
            'quantity' => 200,
        ]);
        DB::table('products')->insert([
            'quantity' => 10,
        ]);
        DB::table('products')->insert([
            'quantity' => 150,
        ]);
        DB::table('products')->insert([
            'quantity' => 90,
        ]);
        
    }
}
