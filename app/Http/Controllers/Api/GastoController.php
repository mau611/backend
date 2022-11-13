<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function index()
    {
        $gastos = Gasto::all();
        return $gastos;
    }

    public function store(Request $request)
    {
        $gasto = new Gasto();
        $gasto->nombre = $request->nombre;
        $gasto->Monto = $request->Monto;
        $gasto->fecha = $request->fecha;
        $gasto->save();
    }

    public function show($id)
    {
        $gasto = Gasto::find($id);
        return $gasto;
    }

    public function update(Request $request, $id)
    {
        $gasto = Gasto::findOrFail($request->id);
        $gasto->nombre = $request->nombre;
        $gasto->Monto = $request->Monto;
        $gasto->fecha = $request->fecha;
        $gasto->save();
        return $gasto;
    }

    public function destroy($id)
    {
        $gasto = Gasto::destroy($id);
        return $gasto;
    }
}
