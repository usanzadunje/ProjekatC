<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function handle(array $userData): User {
        $userData['password'] = Hash::make($userData['password']);

        return User::create($userData);
    }
}