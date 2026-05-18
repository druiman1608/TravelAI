<?php

namespace App\Http\Requests\AIChatLogReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AIChatLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'message'      => 'required|string',
            'context_data' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'El mensaje del usuario es obligatorio.',
        ];
    }
}