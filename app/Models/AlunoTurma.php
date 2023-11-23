<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $aluno_id
 * @property mixed $professor_id
 */
class AlunoTurma extends Model
{
    use HasFactory;

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }
}
