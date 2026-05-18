<?php

namespace App\Http\Requests\FlightReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        return Auth::check() && $user?->isAdmin();
    }

    public function rules(): array
    {
        $flightId = $this->route('flight');

        return [
            'flight_number'      => ['required', 'string', Rule::unique('flights')->ignore($flightId)],
            'origin_loc_id'      => 'required|exists:locations,id',
            'destination_loc_id' => 'required|exists:locations,id|different:origin_loc_id',
            'airline'            => 'required|string|max:255',
            'departure'          => 'required|date',
            'arrival'            => 'required|date|after:departure',
            'capacity'           => 'required|integer|min:1',
            'price'              => 'required|numeric|min:0',
            'duration_time'      => 'nullable|string',
            'stops'              => 'nullable|integer|min:0',
            'extras'       => 'nullable|array',
            'image_flight' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}