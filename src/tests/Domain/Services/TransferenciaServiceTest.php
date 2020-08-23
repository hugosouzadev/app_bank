<?php

namespace Tests\Domain\Services;

use App\Domain\Services\TransferenciaService;
use Tests\TestCase;

class TransferenciaServiceTest extends TestCase
{
    public function testTransferenciaDeComumParaLojista()
    {
        $transferenciaService = new TransferenciaService(2, 1, 50.0);

        $response = $transferenciaService->processaTransferencia();

        dd($response);
    }
}