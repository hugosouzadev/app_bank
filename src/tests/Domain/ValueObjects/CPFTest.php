<?php

namespace Tests\Domain\ValueObjects;

use DomainException;
use Tests\TestCase;
use Transfee\Domain\ValueObjects\CPF;

class CPFTest extends TestCase
{
    public function testValidaCPFCorreto()
    {
        $documento = '059.442.970-69';

        $cpf = new CPF($documento);

        $this->assertEquals($documento, $cpf->cpf);
    }

    public function testValidaCPFIncorreto()
    {
        $documento = '059.442.970-22';

        $this->expectException(DomainException::class);
        $cnpj = new CPF($documento);
    }
}
