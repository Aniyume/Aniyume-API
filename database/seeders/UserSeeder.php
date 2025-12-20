<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $devRole = Role::where('name', 'developer')->first() ?? Role::create(['name' => 'developer', 'display_name' => 'Developer']);

        $admin = User::updateOrCreate(
            ['email' => 'vladjjjsss7@gmail.com'],
            [
                'name' => 'Frontend Admin',
                'password' => Hash::make('kellyadmin'),
                'is_active' => true,
            ]
        );
        $admin->roles()->sync([$adminRole->id]);

        $developer = User::updateOrCreate(
            ['email' => 'zanshugurov07@gmail.com'],
            [
                'name' => 'Backend Developer',
                'password' => Hash::make('$–>%^%,4Dq:7<sM'),
                'is_active' => true,
            ]
        );
        $developer->roles()->sync([$devRole->id]);
    }
}
