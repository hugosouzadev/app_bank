<?php

namespace Tests\Infrastructure\Utilities;

use Tests\TestCase;
use Transfee\Infrastructure\Utilities\ServicoNotificacao;

class ServicoNotificacaoTest extends TestCase
{
    public function testServicoNotificacaoComSucesso()
    {
        $servicoNotificacao = new ServicoNotificacao();

        $resposta = $servicoNotificacao->enviaNotificacao();

        $this->assertEquals(200, $resposta['httpStatus']);
    }
}
