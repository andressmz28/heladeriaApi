<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\licor_pedido;

class LicorPedidoController extends Controller
{
    public function obtenerNombresLicoresPorPedido($pedidoId)
    {
        $nombresLicores = licor_pedido::select('licor.nombre')
            ->leftJoin('licor', 'licor_pedido.licor_id', '=', 'licor.id')
            ->where('licor_pedido.pedido_id', '=', $pedidoId)
            ->get();

        return response()->json($nombresLicores);
    }
}
