<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class UserController extends Controller
{
    public function index(): InertiaResponse {
        $users = User::all('id', 'first_name', 'last_name', 'username');

        return Inertia::render('User/Index', compact('users'));
    }

    public function create() {
        //
    }

    public function store(StoreUserRequest $request, CreateUserAction $createUserAction): InertiaResponse {
        $createUserAction->handle($request->validated());

        return Inertia::render('User/Index');
    }

    public function show(User $user) {
        //
    }

    public function edit(User $user) {
        //
    }

    public function update(UpdateUserRequest $request, User $user) {
        //
    }

    public function destroy(User $user) {
        //
    }
}
