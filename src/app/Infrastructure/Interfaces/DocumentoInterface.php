<?php

namespace App\Infrastructure\Interfaces;

interface DocumentoInterface
{
    public function valida(string $documento): bool;
}
