<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('/api')->group(function () {
    Route::get('/health', function () {
        echo "Ok";
    });
    Route::get('/pub', function () {
        try {
            for ($i= 0 ; $i < 10 ; $i++){
            $payload = new Junges\Kafka\Message\Message(
                headers: ['header' => 'headers'],
                body: ["id" => $i, 'name' => 'name'],
                key: Ramsey\Uuid\Uuid::uuid4()
            );

            \Junges\Kafka\Facades\Kafka::publishOn('consumer-topic')->withDebugEnabled()
                ->withMessage($payload)->send();
            }
        } catch (Throwable $exception) {
            dd($exception);
        }
    });
    Route::post('/transaction', 'UsuarioController@efetuaTransferencia');
});
