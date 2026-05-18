<?php

namespace App\Http\Requests\ActivityReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'location_id'       => 'required|exists:locations,id',
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'duration'          => 'required|string|max:100',
            'price'             => 'required|numeric|min:0',
            'type'              => 'nullable|string|max:100',
            'included_features' => 'nullable|array',
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'extras'   => 'nullable|array',
        ];
    }
}