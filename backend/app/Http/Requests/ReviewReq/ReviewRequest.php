<?php

namespace App\Http\Requests\ReviewReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $rules = [
            'hotel_id'    => 'nullable|exists:hotels,id',
            'flight_id'   => 'nullable|exists:flights,id',
            'package_id'  => 'nullable|exists:packages,id',
            'activity_id' => 'nullable|exists:activities,id',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'required|string|min:5',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
                $rules['status'] = 'required|in:pendiente,aprobada,rechazada,cancelada';
            }
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->isMethod('post')) {
                $servicios = array_filter([
                    $this->package_id,
                    $this->hotel_id,
                    $this->flight_id,
                    $this->activity_id
                ]);

                if (count($servicios) === 0) {
                    $validator->errors()->add('package_id', 'Debes seleccionar al menos un servicio para valorar.');
                }
                if (count($servicios) > 1) {
                    $validator->errors()->add('package_id', 'Solo puedes valorar un servicio por reseña. No selecciones varios.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'comment.min' => 'El comentario es demasiado corto (minimo 5 caracteres).',
            'rating.required' => 'La puntuacion es obligatoria.',
        ];
    }
}
