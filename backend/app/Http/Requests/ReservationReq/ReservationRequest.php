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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'package_id' => 'nullable|exists:packages,id',
            'hotel_id'   => 'nullable|exists:hotels,id',
            'flight_id'  => 'nullable|exists:flights,id',
        ];

        if ($this->isMethod('post')) {
            $rules['package_id'] .= '|required_without_all:hotel_id,flight_id';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['status'] = 'required|in:pendiente,confirmada,cancelada';
        }

        return $rules;
    }
}