<?php

namespace App\Http\Requests\UserReq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->route('user');

        if ($this->isMethod('post')) {
            return $this->user()->isAdmin();
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->user()->can('update', $user);
        }

        if ($this->isMethod('delete')) {
            return $this->user()->can('delete', $user);
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $idUser = $this->route('user') ? $this->route('user')->id : null;
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($idUser),
            ],
            'password' => $this->isMethod('post') ? 'required|min:8|confirmed' : 'nullable|min:8|confirmed',
            'role_id' => [
                'nullable',
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->user()->isAdmin()) {
                        $fail('ERROR: Solo los administradores pueden cambiar o asignar los roles');
                    }
                }
            ],
        ];
    }
}