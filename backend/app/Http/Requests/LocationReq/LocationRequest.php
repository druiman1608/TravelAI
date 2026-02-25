<?php

namespace App\Http\Requests\LocationReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LocationRequest extends FormRequest
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
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'continent' => 'required|string|max:255',
            'weather_type' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url|max:255',
            'status' => 'required|boolean',
        ];
    }
}