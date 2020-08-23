<?php

namespace App\Domain\ValueObjects;

use App\Infrastructure\Interfaces\DocumentoInterface;

class CPF implements DocumentoInterface
{
    public function valida(): bool
    {
        return true;
    }
}
