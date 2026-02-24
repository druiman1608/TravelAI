<?php

namespace App\Http\Requests\ReviewReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewRequest extends FormRequest
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
            'user_id' => Auth::id(),
            'hotel_id' => 'required|exists:hotels,id',
            'flight_id' => 'required|exists:flights,id',
            'package_id' => 'required|exists:packages,id',
            'rating' => 'required|integer|min:1',
            'comment' => 'required|string',
            'status' => 'boolean',
        ];
    }
}
