<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Toping;

class TopingController extends Controller
{
    //


public function index()
{
    $topings = Toping::all();
    return response()->json($topings);
}


public function delete($id)
{
    $topping = Toping::find($id);
    if ($topping) {
        $topping->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 201);
    } else {
        return response()->json(['error' => 'No existe ese id'], 401);
    }
}

public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Toping();
        $create->nombre = $data['nombre'];
        $create->gramos = $data['gramos'];
        $create->precio = $data['precio'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Toping::find($id);
        $update->nombre = $data['nombre'];
        $update->gramos = $data['gramos'];
        $update->precio = $data['precio'];

        $update->save();
        return response()->json($update, 201);
    }



}
