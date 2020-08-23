<?php

namespace App\Http\Controllers\API;

use App\Domain\Services\TransferenciaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function efetuaTransferencia(Request $request): string
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'payer' => 'required|numeric',
            'payee' => 'required|numeric'
        ], [
            'required' => "':attribute' e nao informado",
            'numeric' => "':attribute' deve ser numerico"
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }

        $data = $request->all();
        $transferenciaService = new TransferenciaService($data['payee'], $data['payer'], $data['value']);
        $response = $transferenciaService->processaTransferencia();

        if (!$response['status']) {
            return response()->json(['message' => $response['mensagem']], 400);
        }

        return response()->json(['message' => $response['mensagem']], 200);
    }
}
