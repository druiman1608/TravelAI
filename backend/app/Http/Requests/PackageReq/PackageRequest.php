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
            'hotel_id'    => 'nullable|exists:hotels,id',
            'flight_id'   => 'nullable|exists:flights,id',
            'activity_id' => 'nullable|exists:activities,id',
            'total_price' => 'required|numeric|min:1',
        ];
    }

    public function validator($validator)
    {
        $validator->after(function ($validator) {

            $fields = [
                $this->hotel_id,
                $this->flight_id,
                $this->activity_id
            ];

            $fieldsCount = count(array_filter($fields));

            if ($fieldsCount < 2) {
                $validator->errors()->add('fields', 'Un paquete debe tener almenos 2 servicios');
            }
        });
    }
}