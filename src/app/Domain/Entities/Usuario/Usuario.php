<?php

namespace App\Domain\Entities\Usuario;

use App\Infrastructure\Utilities\Interfaces\UsuarioInterface;
use DomainException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model implements UsuarioInterface
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nomeCompleto',
        'documento',
        'email',
        'usuario_tipo_id',
        'senha'
    ];

    public function buscaCarteira(): HasOne
    {
        return $this->hasOne(\App\Domain\Entities\Carteira\Carteira::class, 'usuarios_id');
    }

    public function buscaPorId(int $id): Usuario
    {
        $usuario = $this->find($id);

        if (empty($usuario)) {
            throw new DomainException("Usuario $id não encontrado");
        }

        return $usuario;
    }

    public function saca(float $valor): void
    {
        $carteira = $this->buscaCarteira()->first();

        if ($carteira->saldo < $valor) {
            throw new DomainException("Saldo insuficiente");
        }

        $carteira->saldo -= $valor;

        $carteira->save();
    }

    public function deposita(Usuario $beneficiario, float $valor): void
    {
        $carteira = $beneficiario->buscaCarteira()->first();

        $carteira->saldo += $valor;

        $carteira->save();
    }
}
