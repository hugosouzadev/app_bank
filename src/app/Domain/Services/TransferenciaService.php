<?php

namespace App\Domain\Services;

use App\Domain\Entities\Usuario\Comum;
use App\Domain\Entities\Usuario\Usuario;
use App\Infrastructure\Interfaces\TransferenciaInterface;
use App\Infrastructure\Utilities\AutorizadorExterno;
use App\Infrastructure\Utilities\ServicoNotificacao;
use DomainException;
use Illuminate\Support\Facades\DB;

class TransferenciaService implements TransferenciaInterface
{
    /** @var int $pagador id do usuário pagado */
    private $idPagador;

    /** @var int $benificiario id do usuário benificiario */
    private $idBenificiario;

    /** @var int $valor valor a ser depositado */
    private $valor;

    public function __construct(int $pagador, int $benificiario, float $valor)
    {
        $this->idPagador = $pagador;
        $this->idBenificiario = $benificiario;
        $this->valor = $valor;
    }

    /**
     * @return array
     * @throws DomainException|Throwable
     **/
    public function processaTransferencia(): array
    {
        try {
            $pagador = (new Comum())->buscaPorId($this->idPagador);

            $benificiario = (new Usuario())->buscaPorId($this->idBenificiario);

            if ($pagador->usuarioTipo_id != Comum::TIPO) {
                throw new DomainException(
                    "Lojista não pode realizar transferencias"
                );
            }

            DB::beginTransaction();

            $autorizadorExterno = new AutorizadorExterno();
            $resposta = $autorizadorExterno->validaTransferencia();

            if ($resposta['httpStatus'] != 200) {
                if (isset($resposta['corpoRequisicao'])) {
                    throw new \DomainException(sprintf('Falha na transfêrencia, status do autorizador: %s', json_encode($resposta['corpoRequisicao'])));
                }
            }

            $pagador->transfere($benificiario, $this->valor);


            $servicoNotificao = new ServicoNotificacao();

            $resposta = $servicoNotificao->enviaNotificacao();

            if ($resposta['httpStatus'] != 200) {
                if (isset($resposta['corpoRequisicao'])) {
                    throw new \DomainException(sprintf('Falha ao enviar notificao: %s', json_encode($resposta['corpoRequisicao'])));
                }
            }

            DB::commit();

            return [
                'status' => true,
                'mensagem' => 'Transferência realizada com sucesso'
            ];
        } catch (DomainException $e) {
            DB::rollBack();
            return [
                'status' => false,
                'mensagem' => $e->getMessage()
            ];
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return [
                'status' => false,
                'mensagem' => 'Ocorreu um erro inesperado'
            ];
        }
    }
}
