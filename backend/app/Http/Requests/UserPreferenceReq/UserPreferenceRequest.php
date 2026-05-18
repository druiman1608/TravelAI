<?php

namespace App\Http\Requests\UserPreferenceReq;

use Illuminate\Foundation\Http\FormRequest;

class UserPreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'travel_type' => 'required|string|max:100',
            'max_budget'  => 'required|numeric|min:0',
            'fav_weather' => 'required|string|max:100',
        ];
    }
}