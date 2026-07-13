<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed core data (products, categories, brands, reviews)
        $this->call([
            MasterSeeder::class,
        ]);

        // Optionally seed a demo user
        User::factory()->create([
            'name' => 'Admin123',
            'email' => 'admin123@example.com',
            'password' => bcrypt('Parth123?'),
        ]);
    }
}
