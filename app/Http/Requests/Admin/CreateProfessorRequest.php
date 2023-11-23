<?php

namespace App\Http\Requests\Admin;

use App\Models\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProfessorRequest extends FormRequest
{
    public function authorize(): bool
    {
       return request()->user()->user_type_id === UserType::ADMIN;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min: 3', 'max: 255'],
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }
}
