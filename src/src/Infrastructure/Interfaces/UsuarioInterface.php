<?php

namespace Transfee\Infrastructure\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Transfee\Domain\Entities\Usuario\Usuario;

interface UsuarioInterface
{
    public function buscaCarteira(): HasOne;

    public function buscaPorId(int $id): Usuario;

    public function saca(float $valor): void;

    public function deposita(Usuario $beneficiario, float $valor): void;
}
