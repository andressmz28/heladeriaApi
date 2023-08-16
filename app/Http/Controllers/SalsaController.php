<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salsa;

class SalsaController extends Controller
{
    //


public function index()
{
    $salsas = Salsa::all();
    return response()->json($salsas);
}


public function delete($id)
{
    $salsa = Salsa::find($id);
    if ($salsa) {
        $salsa->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 201);
    } else {
        return response()->json(['error' => 'No existe ese id'], 401);
    }
}

public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Salsa();
        $create->nombre = $data['nombre'];
        $create->gramos = $data['gramos'];
        $create->precio = $data['precio'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Salsa::find($id);
        $update->nombre = $data['nombre'];
        $update->gramos = $data['gramos'];
        $update->precio = $data['precio'];

        $update->save();
        return response()->json($update, 201);
    }



}
