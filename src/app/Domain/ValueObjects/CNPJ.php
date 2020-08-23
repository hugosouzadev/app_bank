<?php

namespace App\Domain\ValueObjects;

use App\Domain\Interfaces\DocumentoInterface;

class CNPJ implements DocumentoInterface
{
    public function valida(): bool
    {
        return true;
    }
}
