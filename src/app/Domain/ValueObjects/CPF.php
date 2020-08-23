<?php

namespace App\Domain\ValueObjects;

use App\Infrastructure\Utilities\Interfaces\DocumentoInterface;

class CPF implements DocumentoInterface
{
    public function valida(): bool
    {
        return true;
    }
}
