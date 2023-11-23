<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed $id
 * @property mixed|string $name
 */
class UserType extends Model
{
    use HasFactory;

    public const PROFESSOR = 1;
    public const ALUNO = 2;
    public const ADMIN = 3;

    public const ALL = [
        self::PROFESSOR,
        self::ALUNO,
        self::ADMIN
    ];
}


