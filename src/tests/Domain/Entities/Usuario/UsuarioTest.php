<?php

namespace Tests\Domain\Entities\Usuario;

use App\Domain\Entities\Usuario\Usuario;
use DomainException;
use Tests\TransactionTestCase;
use TypeError;

class UsuarioTest extends TransactionTestCase
{
    public function testBuscaUsuarioPorIdExistente()
    {
        $idUsuario = 3;

        $usuario = new Usuario();

        $usuario = $usuario->buscaPorId($idUsuario);

        $this->assertNotEmpty($usuario);
        $this->assertEquals($idUsuario, $usuario->id);
    }
    public function testBuscaUsuarioPorIdInexistente()
    {
        $idUsuario = 9999;

        $usuario = new Usuario();

        $this->expectException(DomainException::class);
        $resposta = $usuario->buscaPorId($idUsuario);
    }

    public function testBuscaUsuarioPorIdPassandoString()
    {
        $idUsuario = 'test';

        $usuario = new Usuario();

        $this->expectException(TypeError::class);
        $resposta = $usuario->buscaPorId($idUsuario);
    }

    public function testBuscaUsuarioPorIdComCarteira()
    {
        $idUsuario = 3;

        $usuario = new Usuario();

        $usuario = $usuario->buscaPorId($idUsuario);
        $usuarioCarteira = $usuario->buscaCarteira()->first();

        $this->assertNotEmpty($usuarioCarteira);
        $this->assertEquals($idUsuario, $usuarioCarteira->usuarios_id);
    }

    public function testSacarComValorPositivo()
    {
        $idUsuario = 3;
        $valor = 50.0;

        $usuario = new Usuario();
        $usuario = $usuario->buscaPorId($idUsuario);

        $saldoAntes = $usuario->buscaCarteira()->first()->saldo;

        $usuario->saca($valor);

        $saldoDepois = $usuario->buscaCarteira()->first()->saldo;
        $this->assertEquals($saldoDepois, $saldoAntes - $valor);
    }

    public function testSacarComValorNegativo()
    {
        $idUsuario = 3;
        $valor = -50.0;

        $usuario = new Usuario();
        $usuario = $usuario->buscaPorId($idUsuario);

        $this->expectException(DomainException::class);
        $resposta = $usuario->saca($valor);
    }

    public function testSacarComValorTipoString()
    {
        $idUsuario = 3;
        $valor = 'teste';

        $usuario = new Usuario();
        $usuario = $usuario->buscaPorId($idUsuario);

        $this->expectException(TypeError::class);
        $resposta = $usuario->saca($valor);
    }

    public function testDepositaComValorPositivo()
    {
        $idUsuario = 3;
        $valor = 50.0;

        $usuario = new Usuario();
        $usuario = $usuario->buscaPorId($idUsuario);

        $saldoAntes = $usuario->buscaCarteira()->first()->saldo;

        $usuario->deposita($usuario, $valor);

        $saldoDepois = $usuario->buscaCarteira()->first()->saldo;
        $this->assertEquals($saldoDepois, $saldoAntes + $valor);
    }

    public function testDepositaComValorNegativo()
    {
        $idUsuario = 3;
        $valor = -50.0;

        $usuario = new Usuario();
        $usuario = $usuario->buscaPorId($idUsuario);

        $this->expectException(DomainException::class);
        $resposta = $usuario->deposita($usuario, $valor);
    }

    public function testDepositaComValorTipoString()
    {
        $idUsuario = 3;
        $valor = 'teste';

        $usuario = new Usuario();
        $usuario = $usuario->buscaPorId($idUsuario);

        $this->expectException(TypeError::class);
        $resposta = $usuario->deposita($usuario, $valor);
    }
}
