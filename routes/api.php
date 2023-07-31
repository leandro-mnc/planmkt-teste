<?php

use App\Http\Controllers\Api\EletrodomesticoController;
use App\Http\Controllers\Api\MarcaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resources([
    'eletrodomestico' => EletrodomesticoController::class
]);

Route::prefix('marca')->group(function () {
    Route::get('/', MarcaController::class . '@listaAtivos');
});
