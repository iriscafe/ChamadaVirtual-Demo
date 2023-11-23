<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoChamada extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chamada_id',
        'esta_presente',
        'esta_justificado'
    ];
    public function aluno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
