<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
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
                Rule::unique(User::class)->ignore(auth()->id()),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore(auth()->id()),
            ],
            'password' => [
                'required',
                'string',
                Password::min(3),
            ],
        ];
    }
}
