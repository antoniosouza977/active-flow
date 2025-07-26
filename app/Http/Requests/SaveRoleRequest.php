<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveRoleRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|exists:roles,id',
            'description' => [
                'required',
                'max:255',
                'min:3',
                Rule::unique('roles', 'description')->ignore($this->id),
            ],
        ];
    }
}
