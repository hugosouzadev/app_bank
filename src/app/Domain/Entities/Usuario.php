<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nomeCompleto',
        'documento',
        'email',
        'usuario_tipo_id',
        'senha'
    ];
}
