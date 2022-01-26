<?php

namespace Transfee\Domain\Entities\Usuario;

use DomainException;

class Comum extends Usuario
{
    const TIPO = 1;

    public function transfere(Usuario $beneficiario, float $valor): void
    {
        if ($valor < 0) {
            throw new DomainException('Não é possivel transferir valor negativo');
        };
        $this->saca($valor);
        $this->deposita($beneficiario, $valor);
    }
}
