<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin user for Filament panel
        $this->call([
            AdminSeeder::class,
        ]);

        // Optional: Create test users
        // User::factory(10)->create();
    }
}
