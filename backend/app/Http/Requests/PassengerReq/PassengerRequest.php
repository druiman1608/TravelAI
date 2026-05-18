<?php

namespace App\Http\Requests\PassengerReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PassengerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'reservation_id'  => 'required|exists:reservations,id',
            'type'            => 'required|in:adult,child,infant',
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'document_number' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'type.in' => 'El tipo de pasajero debe ser: adult, child o infant.',
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
        ];
    }
}