<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $professor_id
 * @property string $nome
 * @property int $disciplina_id
 */
class Turma extends Model
{
    use HasFactory;

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function temChamadaAberta(): bool
    {
        return Chamada::query()->where('turma_id', $this->id)
                    ->where('data_abertura','<=', Carbon::now())
                    ->where('data_termino', '>=', Carbon::now())
                    ->latest()
                    ->exists();
    }

    public function chamadaAberta(): ?Chamada
    {
        return Chamada::query()->where('turma_id', $this->id)
            ->where('data_abertura','<=', Carbon::now())
            ->where('data_termino', '>=', Carbon::now())
            ->orderByDesc('id')
            ->first();
    }

    public function temPresenca($alunoId): bool
    {
        return AlunoChamada::query()->where('turma_id', $this->id)
            ->where('aluno_id', $alunoId)
            ->where('esta_presente', true)
            ->exists();
    }
}
