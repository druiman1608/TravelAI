<?php

namespace App\Http\Requests\FlightOfferReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FlightOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(['one_way', 'round_trip'])],
            'outbound_flight_id' => 'required|exists:flights,id',
            'return_flight_id' => [
                $this->type === 'round_trip' ? 'required' : 'nullable',
                'exists:flights,id'
            ],
            'total_price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'El tipo de oferta es obligatorio (one_way o round_trip).',
            'outbound_flight_id.exists' => 'El vuelo de ida seleccionado no es válido.',
            'return_flight_id.required' => 'Para viajes de ida y vuelta, el vuelo de regreso es obligatorio.',
            'total_price.numeric' => 'El precio debe ser un valor numérico.',
        ];
    }
}