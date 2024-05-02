<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::create(
            [
                "name"=> "User teste",
                "email"=> "user@teste.com.br",
                "password"=> 'password'
            ]
        );

        Product::factory(10)->create();
        
    }
}
