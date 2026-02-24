<?php

namespace App\Http\Requests\PackageReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PackageRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'hotel_id' => 'required|exists:hotels,id',
            'flight_id' => 'required|exists:flights,id',
            'activity_id' => 'required|exists:activities,id',
            'total_price' => 'required|numeric|min:1',
        ];
    }
}
