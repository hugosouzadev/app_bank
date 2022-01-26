<?php

namespace Tests\Infrastructure\Utilities;

use Tests\TestCase;
use Transfee\Infrastructure\Utilities\AutorizadorExterno;

class AutorizadorExternoTest extends TestCase
{
    public function testValidaTransferenciaComSucesso()
    {
        $autorizadorExterno = new AutorizadorExterno();

        $resposta = $autorizadorExterno->validaTransferencia();

        $this->assertEquals(200, $resposta['httpStatus']);
    }
}
