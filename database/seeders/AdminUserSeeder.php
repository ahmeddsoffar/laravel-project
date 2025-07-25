<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    //de custom seeder and  3mlha command: php artisan make:seeder AdminUserSeeder

    public function run(): void
    {
        // test users by seeders 1st time
        //command to run seeder: php artisan db:seed --class=AdminUserSeeder
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),//skip email verification
        ]);

        // Create a regular user for testing
        User::create([
            'name' => 'Regular User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),//skip email verification
        ]);

        $this->command->info('Admin and test users created successfully!');
        $this->command->info('Admin: admin@admin.com / password');
        $this->command->info('User: user@user.com / password');
    }
}
