<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     * @return Response
     */
    public function toResponse($request): Response {

        return $request->wantsJson()
            ? new JsonResponse(['success' => 'Successfully registered, welcome!'], 201)
            : redirect()->intended(Fortify::redirects('register'))->with('success', 'Successfully registered, welcome!');
    }
}