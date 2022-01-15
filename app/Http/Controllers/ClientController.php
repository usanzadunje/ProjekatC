<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ClientController extends Controller
{
    public function index(): InertiaResponse {
        // REFACTOR
        // Mora da bude paginated

        $clients = User::has('place')
            ->with(['place' => fn($query) => $query->select('id', 'name', 'city', 'address', 'user_id')])
            ->select('id', 'email')
            ->orderByDesc('id')
            ->get();


        return Inertia::render('Clients/Index', compact('clients'));
    }

    public function create(): InertiaResponse {
        return Inertia::render('Clients/Create');
    }

    public function store(StoreClientRequest $request, CreateUserAction $createUserAction): RedirectResponse {
        $validatedUserData = $request->validated()['user'];
        $validatedPlaceData = $request->validated()['place'];

        $user = $createUserAction->handle($validatedUserData);
        $user->place()->create($validatedPlaceData);

        return redirect()->route('admin.client.index');
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

    public function destroy(User $client): RedirectResponse {
        $client->delete();

        return redirect()->route('admin.client.index');
    }
}
