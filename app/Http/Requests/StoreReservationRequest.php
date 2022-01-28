<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
{
    protected $fillable = ['reservation_date'];

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
            'place_id' => [
                Rule::requiredIf($this->user()->role === Role::REGULAR),
            ],
            'user_id' => [
                Rule::requiredIf($this->user()->role === Role::STAFF),
            ],
            'reservation_date' => [
                'required',
                'date',
                Rule::unique(Reservation::class),
            ],
            'number_of_guests' => [
                'required',
                'numeric',
                'integer',
                'max:3000',
            ],
            'occasion' => [
                'required',
                'string',
                'max:100',
            ],
            'additional_requirements' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }
}
