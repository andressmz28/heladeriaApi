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
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DulcePedidoController;
use App\Http\Controllers\EspecialPedidoController;
use App\Http\Controllers\FrutaPedidoController;
use App\Http\Controllers\LicorPedidoController;
use App\Http\Controllers\SalsaPedidoController;
use App\Http\Controllers\TopingPedidoController;

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
Route::post('/registrar-usuario', [UsuarioController::class, 'registrarUsuario']);

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

//borrar dulce con id
Route::delete('/dulces/{id}',[DulceController::class, 'delete']);

//crear dulce
Route::post('/dulces/create',[DulceController::class, 'create']);

//editar dulce
Route::put('/dulces/update/{id}', [DulceController::class, 'update']);

//borrar especial con id
Route::delete('/especiales/{id}',[EspecialController::class, 'delete']);

//crear especial
Route::post('/especiales/create',[EspecialController::class, 'create']);

//editar especial
Route::put('/especiales/update/{id}', [EspecialController::class, 'update']);

//borrar frutas con id
Route::delete('/frutas/{id}',[FrutaController::class, 'delete']);

//crear frutas
Route::post('/frutas/create',[FrutaController::class, 'create']);

//editar frutas
Route::put('/frutas/update/{id}', [FrutaController::class, 'update']);

// helados

//borrar licores con id
Route::delete('/licores/{id}',[LicorController::class, 'delete']);

//crear licores
Route::post('/licores/create',[LicorController::class, 'create']);

//editar licores
Route::put('/licores/update/{id}', [LicorController::class, 'update']);

//borrar toppings con id
Route::delete('/topings/{id}',[TopingController::class, 'delete']);

//crear toppings
Route::post('/topings/create',[TopingController::class, 'create']);

//editar toppings
Route::put('/topings/update/{id}', [TopingController::class, 'update']);

//borrar toppings con id
Route::delete('/topings/{id}',[TopingController::class, 'delete']);

//crear toppings
Route::post('/topings/create',[TopingController::class, 'create']);

//editar toppings
Route::put('/topings/update/{id}', [TopingController::class, 'update']);

//borrar salsas con id
Route::delete('/salsas/{id}',[SalsaController::class, 'delete']);

//crear salsas
Route::post('/salsas/create',[SalsaController::class, 'create']);

//editar salsas
Route::put('/salsas/update/{id}', [SalsaController::class, 'update']);

//pedidos

//cantidad de dulces
Route::get('/dulces/cantidad',[DulceController::class,'cantidad']);
Route::get('/especiales/cantidad',[EspecialController::class,'cantidad']);
Route::get('/helados/cantidad',[HeladoController::class,'cantidad']);
Route::get('/licores/cantidad',[LicorController::class,'cantidad']);
Route::get('/salsas/cantidad',[SalsaController::class,'cantidad']);
Route::get('/frutas/cantidad',[FrutaController::class,'cantidad']);
Route::get('/topings/cantidad',[TopingController::class,'cantidad']);
Route::get('/pedidos/cantidadNoAtendido',[PedidoController::class,'cantidadPedidosNoAtendidos']);
Route::get('/pedidos/cantidadNoAtendido2',[PedidoController::class,'cantidadPedidosNoAtendidos2']);
Route::get('/pedidos/pedidosUsuario/{userId}', [PedidoController::class, 'pedidosUsuario']);
Route::get('/pedidos/pedidosUsuariosAdmin', [PedidoController::class, 'pedidosUsuariosAdmin']);
Route::get('/dulcesPedido/obtenerNombresDulcesPorPedido/{pedidoId}', [DulcePedidoController::class, 'obtenerNombresDulcesPorPedido']);
Route::get('/frutasPedido/nombres/{pedidoId}', [FrutaPedidoController::class, 'obtenerNombresFrutasPorPedido']);
Route::get('/especialesPedido/nombres/{pedidoId}', [EspecialPedidoController::class, 'obtenerNombresEspecialesPorPedido']);
Route::get('/licoresPedido/nombres/{pedidoId}', [LicorPedidoController::class, 'obtenerNombresLicoresPorPedido']);
Route::get('/salsasPedido/nombres/{pedidoId}', [SalsaPedidoController::class, 'obtenerNombresSalsasPorPedido']);
Route::get('/topingsPedido/nombres/{pedidoId}', [TopingPedidoController::class, 'obtenerNombresTopingsPorPedido']);
Route::put('/pedidos/{pedidoId}/marcar-atendido', [PedidoController::class, 'marcarComoAtendido']);
Route::get('/usuarios',[UsuarioController::class,'index']);
Route::delete('/usuarios/{id}',[UsuarioController::class, 'delete']);
Route::post('/usuarios/create',[UsuarioController::class, 'create']);
Route::put('/usuarios/update/{id}', [UsuarioController::class, 'update']);
Route::post('/helados/create',[HeladoController::class, 'create']);
Route::put('/helados/update/{id}', [HeladoController::class, 'update']);
Route::delete('/helados/{id}',[HeladoController::class, 'delete']);






Route::post('/pedidos', [PedidoController::class, 'store']);
Route::get('/pedidos/{id}', 'PedidoController@show');


Route::post('/dulce-pedido', [DulceController::class,'crearDulcePedido']);
Route::post('/especial-pedido', [EspecialController::class, 'crearEspecialPedido']);
Route::post('/fruta-pedido', [FrutaController::class, 'crearFrutaPedido']);
Route::post('/licor-pedido', [LicorController::class, 'crearLicorPedido']);
Route::post('/salsa-pedido', [SalsaController::class, 'crearSalsaPedido']);
Route::post('/toping-pedido', [TopingController::class, 'crearTopingPedido']);

