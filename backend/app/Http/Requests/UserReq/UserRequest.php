<?php

namespace App\Http\Requests\UserReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'password' => $this->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
            'role_id'  => 'nullable|exists:roles,id',
            'status'   => 'nullable|in:active,inactive,suspended'
        ];
    }
}