<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ERORRS mn hna 

    
        $faker = Faker::create();

        // Get all category IDs (make sure categories exist first)
        $categoryIds = Category::pluck('id')->toArray();
        
        if (empty($categoryIds)) {
            $this->command->error('❌ No categories found! Please run CategorySeeder first.');
            return;
        }

        // Define products with matching images
        $products = [
            [
                'name' => 'Premium Cotton T-Shirt',
                'description' => 'Comfortable and stylish cotton t-shirt perfect for everyday wear. Made from 100% organic cotton.',
                'price' => 29.99,
                'quantity' => rand(10, 50),
                'discount' => rand(0, 20),
                'image' => null
            ],
            [
                'name' => 'Wireless Charging Pad',
                'description' => 'Fast wireless charging pad compatible with all Qi-enabled devices. Sleek design with LED indicator.',
                'price' => 49.99,
                'quantity' => rand(5, 30),
                'discount' => rand(0, 15),
                'image' => null
            ],
            [
                'name' => 'Sports Performance Activewear',
                'description' => 'High-performance athletic wear designed for comfort and flexibility during intense workouts.',
                'price' => 79.99,
                'quantity' => rand(8, 25),
                'discount' => rand(5, 25),
                'image' => null
            ],
            [
                'name' => 'Premium Baby Stroller',
                'description' => 'Lightweight and durable baby stroller with 5-point safety harness and smooth maneuverability.',
                'price' => 299.99,
                'quantity' => rand(3, 15),
                'discount' => rand(10, 30),
                'image' => null
            ],
            [
                'name' => 'Designer Sunglasses',
                'description' => 'Trendy sunglasses with UV protection and premium frame construction. Perfect for any occasion.',
                'price' => 89.99,
                'quantity' => rand(12, 40),
                'discount' => rand(0, 20),
                'image' => null
            ],
            [
                'name' => 'Classic White Sneakers',
                'description' => 'Versatile white sneakers that go with any outfit. Comfortable sole and premium leather upper.',
                'price' => 119.99,
                'quantity' => rand(15, 60),
                'discount' => rand(0, 15),
                'image' => null
            ],
            [
                'name' => 'Professional Skateboard',
                'description' => 'High-quality skateboard perfect for beginners and pros. Durable deck with smooth-rolling wheels.',
                'price' => 159.99,
                'quantity' => rand(5, 20),
                'discount' => rand(5, 25),
                'image' => null
            ],
            [
                'name' => 'Organic Fresh Vegetables',
                'description' => 'Farm-fresh organic vegetables packed with nutrients. Perfect for healthy meals and cooking.',
                'price' => 12.99,
                'quantity' => rand(20, 100),
                'discount' => rand(0, 10),
                'image' => null
            ],
            [
                'name' => 'Comfort Cotton Socks',
                'description' => 'Soft and breathable cotton socks for all-day comfort. Available in various colors and patterns.',
                'price' => 19.99,
                'quantity' => rand(30, 80),
                'discount' => rand(0, 15),
                'image' => null
            ],
            [
                'name' => 'Elegant Taupe Collection',
                'description' => 'Sophisticated taupe-colored fashion item that adds elegance to any wardrobe. Premium quality materials.',
                'price' => 199.99,
                'quantity' => rand(8, 25),
                'discount' => rand(15, 35),
                'image' => null
            ]
        ];

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'quantity' => $productData['quantity'],
                'discount' => $productData['discount'],
                'category_id' => $faker->randomElement($categoryIds),
                'image' => $productData['image']
            ]);
        }

        $this->command->info('✅ Created 10 products successfully!');
    }
}
