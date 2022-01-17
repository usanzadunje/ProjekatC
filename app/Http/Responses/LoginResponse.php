<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;


class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     * @return Response
     */
    public function toResponse($request) {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false, 'success' => 'Welcome back!'])
            : redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
    }
}