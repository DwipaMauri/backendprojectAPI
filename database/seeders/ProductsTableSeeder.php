<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('products')->insert([
            'name' => 'Produk A',
            'price' => 100,
            'stock' => 50,
            'image' => 'https://kombas.co.id/wp-content/uploads/2023/01/white-denim-jacket-front-view-streetwear-fashion-scaled.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $now = now();
        DB::table('products')->insert([
            'name' => 'Produk B',
            'price' => 150,
            'stock' => 30,
            'image' => 'https://id-live-01.slatic.net/original/9509dff6dc56de28353a925d12f0520f.jpg',
            'created_at' => $now,
            'updated_at' => $now, 
        ]);
    }
}
