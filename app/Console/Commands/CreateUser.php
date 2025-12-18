<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:create {email} {name} {password}';

    protected $description = 'Create a new user with token';

    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->argument('password');

        // получи роль user (она должна уже существовать)
        $userRole = Role::where('name', 'user')->first();

        if (! $userRole) {
            $this->error('Role "user" does not exist!');

            return;
        }

        // создай пользователя
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'is_active' => true,
            ]
        );

        $user->roles()->syncWithoutDetaching([$userRole->id]);

        $token = $user->createToken('api-token')->plainTextToken;

        $this->info('User created successfully!');
        $this->info('Email: '.$email);
        $this->info('Name: '.$name);
        $this->info('Password: '.$password);
        $this->info('Token: '.$token);
    }
}
