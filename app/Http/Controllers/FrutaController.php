<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fruta;

class FrutaController extends Controller
{
    //


public function index()
{
    $frutas = Fruta::all();
    return response()->json($frutas);
}

}
