<?php

namespace App\Http\Requests\Professor;

use App\Models\UserType;
use Illuminate\Foundation\Http\FormRequest;

class CreateChamadasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return request()->user()?->user_type_id === UserType::PROFESSOR;
    }

    public function rules(): array
    {
        return [
            'turma_id' => ['required', 'integer', 'exists:turmas,id'],
            'data_abertura' => ['required', 'date_format:Y-m-d H:i:s'],
            'data_termino' => ['required', 'date_format:Y-m-d H:i:s'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
        ];
    }
}
