<?php

namespace App\Http\Requests\ReservationReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReservationRequest extends FormRequest
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
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'status' => 'required|in:pendiente,confirmada,cancelada',
            ];
        }

        return [
            'package_id' => 'nullable|exists:packages,id',
            'hotel_id' => 'nullable|exists:hotels,id',
            'flight_id' => 'nullable|exists:flights,id',
        ];
    }
}
