<?php

namespace Tests\Infrastructure\Utilities;

use App\Infrastructure\Utilities\ServicoNotificacao;
use Tests\TestCase;

class ServicoNotificacaoTest extends TestCase
{
    public function testServicoNotificacaoComSucesso()
    {
        $servicoNotificacao = new ServicoNotificacao();

        $resposta = $servicoNotificacao->enviaNotificacao();

        $this->assertEquals(200, $resposta['httpStatus']);
    }
}
