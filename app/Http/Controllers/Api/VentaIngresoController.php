<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VentaIngreso;
use Illuminate\Http\Request;

class VentaIngresoController extends Controller
{
    public function index()
    {
        $ventas = VentaIngreso::all();
        return $ventas;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
