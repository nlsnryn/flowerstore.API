<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' => 'Pixie Dream',
            'product_description' => 'Such adorable blooms! Our Pixie Dream bouquet is indeed a dream come to life.',
            'quantity' => 10,
            'price' => 500,
            'status' => true,
        ]);

        Product::create([
            'product_name' => 'Perfect You',
            'product_description' => 'Are you trying to show someone how much you care? Send this special bouquet of flowers to a friend or loved one for a random surprise or special occasion.',
            'quantity' => 10,
            'price' => 500,
            'status' => true,
        ]);

        Product::create([
            'product_name' => 'Sunset Love',
            'product_description' => 'Sunset Love represents the spectacular beauty of a sunset! Dazzle the love of your life with these beautiful blooms.',
            'quantity' => 10,
            'price' => 500,
            'status' => true,
        ]);
    }
}
