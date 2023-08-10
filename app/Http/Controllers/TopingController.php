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

}
