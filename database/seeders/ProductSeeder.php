<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'image' => 'images/nisin.jpg',
                'title' => 'Product 1',
                'description' => 'Deskripsi produk 1',
                'price' => 100000,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'image2.jpg',
                'title' => 'Product 2',
                'description' => 'Deskripsi produk 2',
                'price' => 150000,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'product3.jpg',
                'title' => 'Lampu Gantung Minimalis',
                'description' => 'Lampu gantung minimalis cocok untuk ruang tamu',
                'price' => 200000,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'product4.jpg',
                'title' => 'Lampu Hias LED',
                'description' => 'Lampu hias LED unik untuk dekorasi kamar',
                'price' => 75000,
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'product5.jpg',
                'title' => 'Lampu Meja Kayu',
                'description' => 'Lampu meja dengan alas kayu solid, desain klasik',
                'price' => 150000,
                'stock' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach($products as $product){
            Product::create($product);
        }
    }
}
