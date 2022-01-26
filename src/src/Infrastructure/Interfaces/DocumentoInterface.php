<?php

namespace Transfee\Infrastructure\Interfaces;

interface DocumentoInterface
{
    public function valida(string $documento): bool;
}
