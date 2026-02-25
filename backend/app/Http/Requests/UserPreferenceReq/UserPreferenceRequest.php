<?php

namespace App\Http\Requests\UserPreferenceReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserPreferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $preference = $this->route('userPreference');
        return $preference ? $this->user()->can('update', $preference) : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'travel_type' => 'required|string|max:100',
            'max_budget' => 'required|numeric|min:0',
            'fav_weather' => 'required|string|max:100',
        ];
    }
}