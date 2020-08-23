<?php

namespace App\Domain\ValueObjects;

use App\Infrastructure\Interfaces\DocumentoInterface;

class CNPJ implements DocumentoInterface
{
    public function valida(): bool
    {
        return true;
    }
}
