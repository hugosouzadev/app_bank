<?php

namespace Tests\Domain\ValueObjects;

use App\Domain\ValueObjects\CNPJ;
use DomainException;
use Tests\TestCase;

class CNPJTest extends TestCase
{
    public function testValidaCNPJCorreto()
    {
        $documento = '93.151.535/0001-44';

        $cnpj = new CNPJ($documento);

        $this->assertEquals($documento, $cnpj->cnpj);
    }

    public function testValidaCNPJIncorreto()
    {
        $documento = '93.151.535/0001-43';

        $this->expectException(DomainException::class);
        $cnpj = new CNPJ($documento);
    }
}
