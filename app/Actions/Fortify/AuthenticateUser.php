<?php

namespace App\Actions\Fortify;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Requests\LoginRequest;

class AuthenticateUser
{
    /**
     * Overrides default fortify authentication checks.
     *
     * @param LoginRequest $request
     * @return User|null
     */
    public static function authenticate(LoginRequest $request): User|null {
        $user = User::where('email', $request->username)
            ->orWhere('username', $request->username)
            ->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return null;
        }

        return $user;
    }
}
