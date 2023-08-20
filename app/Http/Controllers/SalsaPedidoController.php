<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\salsa_pedido;

class SalsaPedidoController extends Controller
{
    public function obtenerNombresSalsasPorPedido($pedidoId)
    {
        $nombresSalsas = salsa_pedido::select('salsas.nombre')
            ->leftJoin('salsas', 'salsa_pedido.salsa_id', '=', 'salsas.id')
            ->where('salsa_pedido.pedido_id', '=', $pedidoId)
            ->get();

        return response()->json($nombresSalsas);
    }
}
