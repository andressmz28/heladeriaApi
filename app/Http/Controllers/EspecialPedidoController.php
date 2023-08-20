<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\especial_pedido;



class EspecialPedidoController extends Controller
{
    public function obtenerNombresEspecialesPorPedido($pedidoId)
    {
        $nombresEspeciales = especial_pedido::select('especiales.nombre')
            ->leftJoin('especiales', 'especial_pedido.especial_id', '=', 'especiales.id')
            ->where('especial_pedido.pedido_id', '=', $pedidoId)
            ->get();

        return response()->json($nombresEspeciales);
    }
}
