<?php

namespace App\Http\Requests\Professor;

use App\Models\UserType;
use Illuminate\Foundation\Http\FormRequest;

class CreateTurmaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()?->user_type_id === UserType::PROFESSOR;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string'],
            'disciplina_id' => ['required', 'exists:disciplinas,id']
        ];
    }
}
