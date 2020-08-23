<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Carteira extends Model
{
    protected $fillable = [
        'saldo',
        'usuario_id'
    ];
}
