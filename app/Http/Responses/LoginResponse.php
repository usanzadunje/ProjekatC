<?php

namespace App\Http\Responses;

use App\Models\Role;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * Overriding default redirects of
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request) {
        return match (auth()->user()->role) {
            Role::ADMIN => redirect()->route('dashboard.admin'),
            Role::STAFF => redirect()->route('dashboard.staff'),
            Role::USER => redirect()->route('dashboard.user'),
            default => redirect()->route('welcome'),
        };
    }
}