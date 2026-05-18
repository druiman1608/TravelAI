<?php

namespace App\Http\Requests\HotelRoomReq;

use Illuminate\Foundation\Http\FormRequest;

class HotelRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => 'required|exists:hotels,id',
            'type'     => 'required|string|max:255',
            'price'    => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'stock'    => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'hotel_id.exists' => 'El hotel seleccionado no existe.',
            'type.required'   => 'El tipo de habitación es obligatorio.',
            'price.numeric'   => 'El precio debe ser un número válido.',
            'capacity.min'    => 'La capacidad mínima debe ser de al menos 1 persona.',
            'stock.integer'   => 'El stock debe ser un número entero.',
        ];
    }
}