<?php

namespace Tests\Domain\Entities\Usuario;

use DomainException;
use Tests\TransactionTestCase;
use Transfee\Domain\Entities\Usuario\Comum;
use Transfee\Domain\Entities\Usuario\Usuario;
use TypeError;

class ComumTest extends TransactionTestCase
{
    public function testTransfereComValorPositivo()
    {
        $idPagador = 2;
        $idBeneficiario = 1;
        $valor = 50.0;

        $pagador = new Comum();
        $pagador = $pagador->buscaPorId($idPagador);
        $saldoPagadorAntes = $pagador->buscaCarteira()->first()->saldo;

        $beneficiario = new Usuario();
        $beneficiario = $beneficiario->buscaPorId($idBeneficiario);
        $saldoBenificiarioAntes = $beneficiario->buscaCarteira()->first()->saldo;

        $pagador->transfere($beneficiario, $valor);

        $saldoPagadorDepois = $pagador->buscaCarteira()->first()->saldo;
        $saldoBenificiarioDepois = $beneficiario->buscaCarteira()->first()->saldo;

        $this->assertEquals($saldoPagadorDepois, $saldoPagadorAntes - $valor);
        $this->assertEquals($saldoBenificiarioDepois, $saldoBenificiarioAntes + $valor);
    }

    public function testTransfereComValorNegativo()
    {
        $idPagador = 2;
        $idBeneficiario = 1;
        $valor = -50.0;

        $pagador = new Comum();
        $pagador = $pagador->buscaPorId($idPagador);

        $beneficiario = new Usuario();
        $beneficiario = $beneficiario->buscaPorId($idBeneficiario);

        $this->expectException(DomainException::class);
        $pagador->transfere($beneficiario, $valor);
    }

    public function testTransfereComValorTipoString()
    {
        $idPagador = 2;
        $idBeneficiario = 1;
        $valor = 'teste';

        $pagador = new Comum();
        $pagador = $pagador->buscaPorId($idPagador);

        $beneficiario = new Usuario();
        $beneficiario = $beneficiario->buscaPorId($idBeneficiario);

        $this->expectException(TypeError::class);
        $pagador->transfere($beneficiario, $valor);
    }
}
