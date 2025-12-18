<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create first admin user';

    public function handle()
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'display_name' => 'Administrator',
        ]);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'is_active' => true,
            ]
        );

        $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);

        $token = $adminUser->createToken('api-token')->plainTextToken;

        $this->info('Admin created successfully!');
        $this->info('Email: admin@example.com');
        $this->info('Password: admin123');
        $this->info('Token: '.$token);
    }
}
