<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IngresoProductoUso;

class IngresoProductoController extends Controller
{
    public function index()
    {
        $ingresos = IngresoProductoUso::with("producto")->get();
        return $ingresos;
    }

    public function store(Request $request)
    {
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
