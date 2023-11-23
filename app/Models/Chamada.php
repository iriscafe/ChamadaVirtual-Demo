<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $professor_id
 * @property int $turma_id
 * @property mixed $data_abertura
 * @property mixed $data_termino
 * @property mixed $latitude1
 * @property mixed $latitude2
 * @property mixed $longitude1
 * @property mixed $longitude2
 * @property mixed $latitude
 * @property mixed $longitude
 */
class Chamada extends Model
{
    use HasFactory;

    protected $casts = [
        'data_termino' => 'datetime',
        'data_abertura' => 'datetime'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function alunoEstaPresente($alunoId): bool
    {
        return AlunoChamada::query()->where('chamada_id', $this->id)
            ->where('user_id', $alunoId)
            ->where('esta_presente', true)
            ->exists();
    }
}
