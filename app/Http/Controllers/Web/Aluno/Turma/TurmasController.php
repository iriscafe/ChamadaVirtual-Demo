<?php

namespace App\Http\Controllers\Web\Aluno\Turma;

use App\Http\Controllers\Controller;
use App\Models\AlunoTurma;
use App\Models\Turma;

class TurmasController extends Controller
{
    public function index()
    {
        $aluno = auth()->user();
        $turmasIds = AlunoTurma::query()->where('aluno_id', $aluno->id)->pluck('turma_id');
        $turmas = Turma::query()->whereIn('id', $turmasIds)->get();
        return view('alunos.turma.index', compact('aluno', 'turmas'));
    }
}
