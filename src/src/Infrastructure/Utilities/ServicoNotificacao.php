<?php

namespace Transfee\Infrastructure\Utilities;

use GuzzleHttp\Exception\RequestException;
use Transfee\Infrastructure\Interfaces\NotificacaoInterface;

class ServicoNotificacao implements NotificacaoInterface
{
    /** @var string $host */
    private string $host;

    public function __construct()
    {
        $this->host = getenv("SERVICO_NOTIFICACAO_HOST");
    }

    public function enviaNotificacao(): array
    {
        try {
            $cliente = new \GuzzleHttp\Client();

            $resposta = $cliente->request('post', $this->host);
        } catch (RequestException $e) {
            $resposta = $e->getResponse();
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            return [
                'httpStatus' => $resposta->getStatusCode(),
                'corpoRequisicao' => (array)json_decode($resposta->getBody()->getContents())
            ];
        }
    }
}
