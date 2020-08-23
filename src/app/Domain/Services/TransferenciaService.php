<?php

namespace App\Domain\Services;

use App\Domain\Entities\Usuario\Comum;
use App\Domain\Entities\Usuario\Usuario;
use App\Infrastructure\Utilities\Interfaces\TransferenciaInterface;
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
            if ($this->valor < 0) {
                throw new DomainException('Não é possivel transferir valor negativo');
            };

            $pagador = (new Comum())->buscaPorId($this->idPagador);

            $benificiario = (new Usuario())->buscaPorId($this->idBenificiario);

            if ($pagador->usuarioTipo_id != Comum::TIPO) {
                throw new DomainException(
                    "Lojista não pode realizar transferencias"
                );
            }

            DB::beginTransaction();

            $pagador->transfere($benificiario, $this->valor);

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
            DB::rollBack();
            return [
                'status' => false,
                'mensagem' => 'Ocorreu um erro inesperado'
            ];
        }
    }
}
