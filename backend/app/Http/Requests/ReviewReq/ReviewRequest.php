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
            'comment'     => 'required|string|min:5|max:1000',
        ];

        if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
            $rules['status'] = 'required|in:pending,approved,rejected';
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
                    $validator->errors()->add('servicio', 'Debes seleccionar qué estás valorando.');
                }
                if (count($servicios) > 1) {
                    $validator->errors()->add('servicio', 'Solo puedes valorar un elemento por reseña.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'La puntuación es obligatoria.',
            'comment.min'     => 'El comentario debe tener al menos 5 caracteres.',
            'status.in'       => 'El estado seleccionado no es válido.',
        ];
    }
}