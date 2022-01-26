<?php

namespace Transfee\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Transfee\Domain\Services\TransferenciaService;
use function response;

class UsuarioController extends Controller
{
    public function efetuaTransferencia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'payer' => 'required|numeric',
            'payee' => 'required|numeric'
        ], [
            'required' => "Não informado",
            'numeric' => "Deve ser númerico"
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }

        $data = $request->all();
        $transferenciaService = new TransferenciaService($data['payer'], $data['payee'], $data['value']);
        $response = $transferenciaService->processaTransferencia();

        if (!$response['status']) {
            return response()->json(['message' => $response['mensagem']], 400);
        }

        return response()->json(['message' => $response['mensagem']], 200);
    }
}
