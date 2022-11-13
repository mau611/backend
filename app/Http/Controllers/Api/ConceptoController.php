<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Concepto;
use Illuminate\Http\Request;

class ConceptoController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::all();
        return $conceptos;
    }

    public function store(Request $request)
    {
        $concepto = new Concepto();
        $concepto->nombre = $request->nombre;
        $concepto->cantidad = $request->cantidad;
        $concepto->precio = $request->precio;
        $concepto->subtotal = $request->subtotal;
        $concepto->factura_id = $request->factura_id;

        $concepto->save();
    }

    public function show($id)
    {
        $concepto = Concepto::find($id);
        return $concepto;
    }

    public function update(Request $request, $id)
    {
        $concepto = Concepto::findOrFail($request->id);
        $concepto->nombre = $request->nombre;
        $concepto->cantidad = $request->cantidad;
        $concepto->precio = $request->precio;
        $concepto->subtotal = $request->subtotal;
        $concepto->factura_id = $request->factura_id;

        $concepto->save();
        return $concepto;
    }

    public function destroy($id)
    {
        $concepto = Concepto::destroy($id);
        return $concepto;
    }
}
