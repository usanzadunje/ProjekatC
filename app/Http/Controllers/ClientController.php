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
    /**
     * Displays all clients of the application.
     *
     * @return InertiaResponse
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return InertiaResponse
     */
    public function create(): InertiaResponse {
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @param CreateUserAction $createUserAction
     * @return RedirectResponse
     */
    public function store(StoreClientRequest $request, CreateUserAction $createUserAction): RedirectResponse {
        $validatedUserData = $request->validated()['user'];
        $validatedPlaceData = $request->validated()['place'];

        $user = $createUserAction->handle($validatedUserData);
        $user->place()->create($validatedPlaceData);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $client
     * @return RedirectResponse
     */
    public function destroy(User $client): RedirectResponse {
        $client->delete();

        return redirect()->route('admin.client.index');
    }
}
