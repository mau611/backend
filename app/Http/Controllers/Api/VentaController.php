<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return $ventas;
    }

    public function store(Request $request)
    {
        $venta = new Venta();
        $venta->fecha = $request->fecha;
        $venta->numero = $request->numero;
        $venta->total = $request->total;
        $venta->estado = $request->estado;
        $venta->tipo_pago = $request->tipo_pago;
        $venta->detalles_pago = $request->detalles_pago;
        $venta->observaciones = $request->observaciones;
        $venta->save();
    }

    public function show($id)
    {
        $venta = Venta::find($id);
        return $venta;
    }

    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->fecha = $request->fecha;
        $venta->numero = $request->numero;
        $venta->total = $request->total;
        $venta->estado = $request->estado;
        $venta->tipo_pago = $request->tipo_pago;
        $venta->detalles_pago = $request->detalles_pago;
        $venta->observaciones = $request->observaciones;
        $venta->save();
        return $venta;
    }

    public function destroy($id)
    {
        $venta = Venta::destroy($id);
        return $venta;
    }
}
