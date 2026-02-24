<?php

namespace App\Http\Requests\FlightReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var \App\Models\User $user */

        $user = Auth::user();
        return Auth::check() && $user->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'location_id' => 'required|exists:locations,id',
            'airline' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'departure' => 'required|date|after:now',
            'arrival' => 'required|date|after:departure',
            'price' => 'required|numeric|min:1',
        ];
    }
}
