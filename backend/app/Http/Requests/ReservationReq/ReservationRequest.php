<?php

namespace App\Http\Requests\ReservationReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $rules = [
            'package_id'    => 'nullable|exists:packages,id',
            'hotel_id'      => 'nullable|exists:hotels,id',
            'flight_id'     => 'nullable|exists:flights,id',
            'activity_id'   => 'nullable|exists:activities,id',
            'contact_name'    => 'required|string|max:255',
            'contact_dni'     => 'required|string|max:20',
            'contact_email'   => 'required|email',
            'contact_phone'   => 'required|string',
            'total_price'     => 'required|numeric',
            'extras'          => 'nullable|array',
            'passengers_data' => 'nullable|array',
            'hotel_room_id'   => 'nullable|exists:hotel_rooms,id',
        ];

        if ($this->isMethod('post')) {
            $fields = 'package_id,hotel_id,flight_id,activity_id';
            $rules['package_id']  .= "|required_without_all:$fields";
            $rules['hotel_id']    .= "|required_without_all:$fields";
            $rules['flight_id']   .= "|required_without_all:$fields";
            $rules['activity_id'] .= "|required_without_all:$fields";
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['status'] = 'required|in:pending,confirmed,cancelled';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required_without_all' => 'Debes seleccionar al menos un servicio para realizar la reserva.',
            'total_price.required' => 'El precio total es obligatorio.',
            'status.in'            => 'El estado seleccionado no es válido (pending, confirmed, cancelled).',
        ];
    }
}