<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DulceController;
use App\Http\Controllers\EspecialController;
use App\Http\Controllers\FrutaController;
use App\Http\Controllers\HeladoController;
use App\Http\Controllers\LicorController;
use App\Http\Controllers\TopingController;
use App\Http\Controllers\SalsaController;
use App\Http\Controllers\PedidoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/dulces',       [DulceController::class,'index']);
Route::get('/especiales',   [EspecialController::class,'index']);
Route::get('/frutas',       [FrutaController::class,'index']);
Route::get('/helados',      [HeladoController::class,'index']);
Route::get('/licores',      [LicorController::class,'index']);
Route::get('/topings',      [TopingController::class,'index']);
Route::get('/salsas',       [SalsaController::class,'index']);

Route::post('/pedidos', [PedidoController::class,'crearPedido']);
Route::get('/pedidos/{id}', [PedidoController::class,'show']);

Route::post('/dulce-pedido', [DulceController::class,'crearDulcePedido']);
Route::post('/especial-pedido', [EspecialController::class, 'crearEspecialPedido']);
Route::post('/fruta-pedido', [FrutaController::class, 'crearFrutaPedido']);
Route::post('/licor-pedido', [LicorController::class, 'crearLicorPedido']);
Route::post('/salsa-pedido', [SalsaController::class, 'crearSalsaPedido']);
Route::post('/toping-pedido', [TopingController::class, 'crearTopingPedido']);

