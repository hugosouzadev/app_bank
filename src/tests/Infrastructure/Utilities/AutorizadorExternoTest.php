<?php

namespace Tests\Infrastructure\Utilities;

use App\Infrastructure\Utilities\AutorizadorExterno;
use Tests\TestCase;

class AutorizadorExternoTest extends TestCase
{
    public function testValidaTransferenciaComSucesso()
    {
        $autorizadorExterno = new AutorizadorExterno();

        $resposta = $autorizadorExterno->validaTransferencia();

        $this->assertEquals(200, $resposta['httpStatus']);
    }
}
