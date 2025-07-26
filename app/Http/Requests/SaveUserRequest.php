<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'       => 'nullable|exists:users,id',
            'name'     => 'required|string|max:255',
//            'email'    => 'required|string|email|max:255|unique:users,email,' . $this->id,
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->id)
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed', Rule::requiredIf(fn() => empty($this->id))],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'Nome',
            'email'    => 'E-mail',
            'password' => 'Senha',
        ];
    }

//    public function messages()
//    {
//        return [
//            'email.unique' => 'Email já cadastrado'
//        ];
//    }
}
