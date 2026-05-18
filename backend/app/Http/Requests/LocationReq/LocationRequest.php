<?php

namespace App\Http\Requests\LocationReq;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city'         => 'required|string|max:255',
            'country'      => 'required|string|max:255',
            'continent'    => 'required|string|max:255',
            'weather_type' => 'required|string|max:255',
            'description'  => 'required|string',
            'status'       => 'boolean'
        ];
    }
}