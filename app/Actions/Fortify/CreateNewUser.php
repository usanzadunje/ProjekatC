<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input) {
        $validatedData = Validator::make($input, [
            'first_name' => [
                'nullable',
                'string',
                'alpha',
                'max:100',
            ],
            'last_name' => [
                'nullable',
                'string',
                'alpha',
                'max:100',
            ],
            'username' => [
                'nullable',
                'string',
                'min:3',
                'max:100',
                Rule::unique(User::class),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $validatedData['password'] = Hash::make($validatedData['password']);

        return User::create($validatedData);
    }
}
