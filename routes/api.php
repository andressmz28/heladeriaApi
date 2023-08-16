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

//ver dulces
Route::get('/dulces',       [DulceController::class,'index']);

//ver especiales
Route::get('/especiales',   [EspecialController::class,'index']);

//ver frutas
Route::get('/frutas',       [FrutaController::class,'index']);

Route::get('/helados',      [HeladoController::class,'index']);

//ver licores
Route::get('/licores',      [LicorController::class,'index']);

//ver toppings
Route::get('/topings',      [TopingController::class,'index']);

//ver salsas
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



Route::post('/pedidos', 'PedidoController@store');
Route::get('/pedidos/{id}', 'PedidoController@show');

