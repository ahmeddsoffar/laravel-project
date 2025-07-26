<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,    // First create admin and test users
            CategorySeeder::class,      // Then create categories
            ProductSeeder::class,       // Finally create products
        ]);
    }
}
