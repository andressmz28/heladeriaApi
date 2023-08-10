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

}
