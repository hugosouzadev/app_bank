<?php

namespace Transfee\Infrastructure\Interfaces;

interface AutorizadorInterface
{
    public function validaTransferencia(): array;
}
