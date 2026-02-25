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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $rules = [
            'hotel_id'   => 'nullable|exists:hotels,id',
            'flight_id'  => 'nullable|exists:flights,id',
            'package_id' => 'nullable|exists:packages,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|min:5',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if ($user->isAdmin() || $user->isMod()) {
                $rules['status'] = 'required|in:pendiente,publicada,borrada';
            }
        }

        return $rules;
    }
}