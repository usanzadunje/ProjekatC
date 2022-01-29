<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservationRequest extends FormRequest
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
            'reservation_date' => [
                'required',
                'date',
                Rule::unique(Reservation::class)->ignore($this->route('reservation')),
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
            'offers.*' => [
                'nullable',
                'numeric',
                'integer',
                Rule::exists('offers', 'id')->where('place_id', $this->request->get('place_id')),
            ],
        ];
    }
}
