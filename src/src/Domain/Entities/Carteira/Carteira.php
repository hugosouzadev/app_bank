<?php

namespace Transfee\Domain\Entities\Carteira;

use Illuminate\Database\Eloquent\Model;

class Carteira extends Model
{
    protected $fillable = [
        'saldo',
        'usuarioId'
    ];
}
