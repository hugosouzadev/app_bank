<?php

namespace App\Domain\Traits;

use DomainException;

trait UsuarioTrait
{
    public function validaValor(float $valor)
    {
        if ($valor < 0) {
            throw new DomainException('Não é possivel transferir valor negativo');
        };
    }
}