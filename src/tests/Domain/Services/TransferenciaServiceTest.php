<?php

namespace Tests\Domain\Services;

use Tests\TransactionTestCase;
use Transfee\Domain\Services\TransferenciaService;

class TransferenciaServiceTest extends TransactionTestCase
{
    public function testTransferenciaDeComumParaLojistaComSaldoSuficiente()
    {
        $transferenciaService = new TransferenciaService(2, 1, 50.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertTrue($resposta['status']);
    }

    public function testTransferenciaDeComumParaLojistaComSaldoInsuficiente()
    {
        $transferenciaService = new TransferenciaService(2, 1, 5000.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertFalse($resposta['status']);
    }

    public function testTransferenciaDeComumParaComumComSaldoSuficiente()
    {
        $transferenciaService = new TransferenciaService(2, 4, 50.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertTrue($resposta['status']);
    }

    public function testTransferenciaDeComumParaComumComSaldoInsuficiente()
    {
        $transferenciaService = new TransferenciaService(2, 4, 5000.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertFalse($resposta['status']);
    }

    public function testTransferenciaDeLojistaParaComumComSaldoSuficiente()
    {
        $transferenciaService = new TransferenciaService(1, 2, 50.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertFalse($resposta['status']);
    }

    public function testTransferenciaDeLojistaParaComumComSaldoInsuficiente()
    {
        $transferenciaService = new TransferenciaService(1, 2, 5000.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertFalse($resposta['status']);
    }

    public function testTransferenciaDeLojistaParaLojistaComSaldoSuficiente()
    {
        $transferenciaService = new TransferenciaService(1, 3, 50.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertFalse($resposta['status']);
    }

    public function testTransferenciaDeLojistaParaLojistaComSaldoInsuficiente()
    {
        $transferenciaService = new TransferenciaService(1, 3, 5000.0);

        $resposta = $transferenciaService->processaTransferencia();

        $this->assertFalse($resposta['status']);
    }
}
