<?php

namespace App\Http\Controllers\Api\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\AdicionarAlunoAturmaRequest;
use App\Http\Requests\Professor\CreateTurmaRequest;
use App\Models\AlunoTurma;
use App\Models\Turma;
use Illuminate\Http\JsonResponse;

class TurmaController extends Controller
{
    public function create(CreateTurmaRequest $request): JsonResponse
    {
        $turma = new Turma();
        $turma->professor_id = request()->user()->id;
        $turma->nome = $request->input('nome');
        $turma->disciplina_id = $request->input('disciplina_id');
        $turma->save();

        return new JsonResponse($turma);
    }

    public function adicionarAlunoATurma(AdicionarAlunoAturmaRequest $request): JsonResponse
    {
        $alunoTurma = new AlunoTurma();
        $alunoTurma->aluno_id = $request->input('aluno_id');
        $alunoTurma->professor_id = $request->input('professor_id');
        $alunoTurma->save();

        return new JsonResponse($alunoTurma);
    }
}
