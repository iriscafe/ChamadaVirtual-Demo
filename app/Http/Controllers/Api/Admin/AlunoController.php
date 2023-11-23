<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProfessorRequest;
use App\Models\User;
use App\Models\UserType;
use Symfony\Component\HttpFoundation\JsonResponse;

class AlunoController extends Controller
{
    public function create(CreateProfessorRequest $request): JsonResponse
    {
        $professor = new User();
        $professor->name = $request->input('name');
        $professor->cpf = $request->input('cpf');
        $professor->password = bcrypt($request->input('password'));
        $professor->user_type_id = UserType::ALUNO;
        $professor->save();

        return new JsonResponse($professor);
    }
}
