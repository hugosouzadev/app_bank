<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\Usuario\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;

interface UsuarioInterface
{
    public function buscaCarteira(): HasOne;

    public function buscaPorId(int $id): Usuario;

    public function saca(float $valor): void;

    public function deposita(Usuario $beneficiario, float $valor): void;
}
