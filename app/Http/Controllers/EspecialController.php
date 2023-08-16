<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especial;
use App\Models\especial_pedido;


class EspecialController extends Controller
{
    //


    public function index()
    {
        $especiales = Especial::all();
        return response()->json($especiales);
    }
    public function crearEspecialPedido(Request $request)
    {
        $especialPedido = especial_pedido::create($request->all());
        return response()->json($especialPedido, 201);
    }


public function delete($id)
{
    $especial = Especial::find($id);
    if ($especial) {
        $especial->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 201);
    } else {
        return response()->json(['error' => 'No existe ese id'], 401);
    }
}

public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Especial();
        $create->nombre = $data['nombre'];
        $create->gramos = $data['gramos'];
        $create->precio = $data['precio'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Especial::find($id);
        $update->nombre = $data['nombre'];
        $update->gramos = $data['gramos'];
        $update->precio = $data['precio'];

        $update->save();
        return response()->json($update, 201);
    }

}
