<?php

namespace App\Http\Requests\HotelReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // /** @var \App\Models\User $user */

        // $user = Auth::user();
        // return Auth::check() && $user->isAdmin();

        return true;
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
            'price_per_night' => 'required|numeric|min:1',
        ];
    }
}
