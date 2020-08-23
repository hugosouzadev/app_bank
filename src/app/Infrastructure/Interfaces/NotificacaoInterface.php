<?php

namespace App\Infrastructure\Interfaces;

interface NotificacaoInterface
{
    public function enviaNotificacao(): array;
}