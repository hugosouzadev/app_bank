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
    Route::get('/health', function() {
        echo "Ok";
    });
    Route::post('/transaction', 'UsuarioController@efetuaTransferencia');
});
