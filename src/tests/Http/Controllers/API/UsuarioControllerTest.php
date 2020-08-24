<?php

declare(strict_types=1);

namespace Tests\Http\Controllers\API;

use Tests\TransactionTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UsuarioControllerTest extends TransactionTestCase
{
    public function testRequisicaPassandoValoresInteiros()
    {
        $response = $this->postJson('/transaction', [
            'payer' => 1,
            'payee' => 2,
            'value' => 50.0
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Transferência realizada com sucesso',
            ]);
    }
    public function testRequisicaoSemValores()
    {
        $response = $this->postJson('/transaction');

        $response
            ->assertStatus(400)
            ->assertJson([
                "message" => [
                    "value" => [
                        "Não informado"
                    ],
                    "payer" => [
                        "Não informado"
                    ],
                    "payee" => [
                        "Não informado"
                    ]
                ]
            ]);
    }

    public function testRequisicaoPassandoString()
    {
        $response = $this->postJson('/transaction', [
            'payer' => 'payer',
            'payee' => 'payee',
            'value' => 'value'
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                "message" => [
                    "value" => [
                        "Deve ser númerico"
                    ],
                    "payer" => [
                        "Deve ser númerico"
                    ],
                    "payee" => [
                        "Deve ser númerico"
                    ]
                ]
            ]);
    }
}
