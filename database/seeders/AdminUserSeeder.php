<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Get the Administrator role
        $adminRole = Role::where('name', 'Administrator')->first();

        // Attach the Administrator role to the user
        if ($adminRole) {
            $admin->roles()->attach($adminRole->id);
        }

        $this->command->info('Admin user created successfully!');
        $this->command->info('username: admin');
        $this->command->info('Password: admin123');
    }
} 