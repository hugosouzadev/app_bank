<?php

namespace App\Infrastructure\Utilities;

use App\Infrastructure\Interfaces\AutorizadorInterface;
use GuzzleHttp\Exception\RequestException;

class AutorizadorExterno implements AutorizadorInterface
{
    /** @var string $host */
    private string $host;

    public function __construct()
    {
        $this->host = getenv("AUTORIZADOR_EXTERNO_HOST");
    }

    public function validaTransferencia(): array
    {
        try {
            $cliente = new \GuzzleHttp\Client();

            $resposta = $cliente->request('get', $this->host);
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
