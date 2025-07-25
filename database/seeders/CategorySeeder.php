<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'T-Shirts & Tops',
            'Sports & Activewear',
            'Accessories',
            'Baby & Kids',
            'Electronics'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName
            ]);
        }

        $this->command->info('✅ Created 5 categories successfully!');
    }
}
