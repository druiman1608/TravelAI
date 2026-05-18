<?php

namespace App\Http\Requests\HotelReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class HotelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'location_id'     => 'required|exists:locations,id',
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'address'         => 'required|string|max:255',
            'zip_code'        => 'required|string|max:20',
            'stars'           => 'required|integer|min:1|max:5',
            'available_rooms' => 'required|integer|min:0',
            'price_per_night' => 'required|numeric|min:0',
            'services'        => 'nullable|array',
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'location_id.exists' => 'La ubicación seleccionada no es válida.',
            'stars.max'          => 'El máximo de estrellas permitido es 5.',
            'images.*.image' => 'Cada archivo debe ser una imagen válida.',
        ];
    }
}