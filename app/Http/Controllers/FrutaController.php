<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fruta;
use App\Models\fruta_pedido;

class FrutaController extends Controller
{
    //


public function index()
{
    $frutas = Fruta::all();
    return response()->json($frutas);
}
public function crearFrutaPedido(Request $request)
    {
        $frutaPedido = fruta_pedido::create($request->all());
        return response()->json($frutaPedido, 201);
    }


public function delete($id)
{
    $fruta = Fruta::find($id);
    if ($fruta) {
        $fruta->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 201);
    } else {
        return response()->json(['error' => 'No existe ese id'], 401);
    }
}

public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Fruta();
        $create->nombre = $data['nombre'];
        $create->gramos = $data['gramos'];
        $create->precio = $data['precio'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Fruta::find($id);
        $update->nombre = $data['nombre'];
        $update->gramos = $data['gramos'];
        $update->precio = $data['precio'];

        $update->save();
        return response()->json($update, 201);
    }

    public function cantidad()
    {
        $count = Fruta::count();
        return response()->json([$count]);
    }



}
