<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'product_name' => 'Milk',
            'product_des' => 'Milk',
            'quantity' => 20,
            'price' => 1.5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'product_name' => 'juice',
            'product_des' => 'Juice',
            'quantity' => 150,
            'price' => 0.5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'product_name' => 'Cream',
            'product_des' => 'cream',
            'quantity' => 30,
            'price' => 0.8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'product_name' => 'Cheese',
            'product_des' => 'cheese',
            'quantity' => 23,
            'price' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'product_name' => 'cola',
            'product_des' => 'coca cola',
            'quantity' => 300,
            'price' => 0.3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
