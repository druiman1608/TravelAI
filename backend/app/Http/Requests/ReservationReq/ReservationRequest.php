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
     */
    public function rules(): array
    {
        $rules = [
            'package_id'  => 'nullable|exists:packages,id',
            'hotel_id'    => 'nullable|exists:hotels,id',
            'flight_id'   => 'nullable|exists:flights,id',
            'activity_id' => 'nullable|exists:activities,id',
            'price'       => 'nullable|numeric|min:0',
        ];

        if ($this->isMethod('post')) {
            $rules['package_id']  .= '|required_without_all:hotel_id,flight_id,activity_id';
            $rules['hotel_id']    .= '|required_without_all:package_id,flight_id,activity_id';
            $rules['flight_id']   .= '|required_without_all:package_id,hotel_id,activity_id';
            $rules['activity_id'] .= '|required_without_all:package_id,hotel_id,flight_id';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['status'] = 'required|in:pendiente,confirmada,cancelada';
        }

        return $rules;
    }

    /**
     * Mensajes
     */
    public function messages(): array
    {
        return [
            'package_id.required_without_all'  => 'Debes seleccionar al menos un servicio (Paquete, Hotel, Vuelo o Actividad).',
            'hotel_id.required_without_all'    => 'Selecciona al menos una opcion para realizar la reserva.',
            'flight_id.required_without_all'   => 'La reserva no puede estar vacia.',
            'activity_id.required_without_all' => 'Por favor, elige algo para reservar.',
            'status.required'                  => 'El estado es obligatorio.',
            'status.in'                        => 'El estado seleccionado no es valido.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->isMethod('post') && !$this->has('user_id')) {
            $this->merge([
                'user_id' => Auth::id(),
            ]);
        }
    }
}
