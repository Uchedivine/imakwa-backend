<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the admin user for Filament panel access.
     */
    public function run(): void
    {
        // Create admin user if doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@imakwa.com'],
            [
                'name' => 'Imakwa Admin',
                'password' => Hash::make('Admin@2026!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('📧 Email: admin@imakwa.com');
        $this->command->info('🔑 Password: Admin@2026!');
    }
}
