<?php

namespace App\Http\Requests\PackageReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'hotel_id'       => 'nullable|exists:hotels,id',
            'flight_id'      => 'nullable|exists:flights,id',
            'activity_id'    => 'nullable|exists:activities,id',
            'total_price'    => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:total_price',
            'itinerary'      => 'nullable|array',
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}