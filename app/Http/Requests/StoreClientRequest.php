<?php

namespace App\Http\Requests;

use App\Models\Place;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreClientRequest extends FormRequest
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
            'user.email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class, 'email'),
            ],
            'user.password' => [
                'required',
                'string',
                Password::min(3),
            ],
            'place.name' => [
                'required',
                'string',
                'max:100',
                Rule::unique(Place::class, 'name'),
            ],
            'place.city' => [
                'required',
                'string',
                'alpha',
                'max:100',
            ],
            'place.address' => [
                'required',
                'string',
                'max:150',
            ],
        ];
    }
}
