<?php

namespace App\Infrastructure\Interfaces;

interface AutorizadorInterface
{
    public function validaTransferencia(): array;
}
