<?php

namespace App\Domain\Entities\Usuario;

class Comum extends Usuario
{
    const TIPO = 1;

    public function transfere(Usuario $beneficiario, float $valor): void
    {
        $this->validaValor($valor);
        $this->saca($valor);
        $this->deposita($beneficiario, $valor);
    }
}
