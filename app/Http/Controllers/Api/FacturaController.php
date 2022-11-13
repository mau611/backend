<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::all();
        return $facturas;
    }

    public function store(Request $request)
    {
        $factura = new Factura();
        $factura->fecha = $request->fecha;
        $factura->numero = $request->numero;
        $factura->total = $request->total;
        $factura->estado_pago = $request->estado_pago;
        $factura->forma_pago = $request->forma_pago;
        $factura->detalles_pago = $request->detalles_pago;
        $factura->consulta_id = $request->consulta_id;
        $factura->save();
    }

    public function show($id)
    {
        $factura = Factura::find($id);
        return $factura;
    }

    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($request->id);
        $factura->fecha = $request->fecha;
        $factura->numero = $request->numero;
        $factura->total = $request->total;
        $factura->estado_pago = $request->estado_pago;
        $factura->forma_pago = $request->forma_pago;
        $factura->detalles_pago = $request->detalles_pago;
        $factura->consulta_id = $request->consulta_id;
        $factura->save();
        return $factura;
    }

    public function destroy($id)
    {
        $factura = Factura::destroy($id);
        return $factura;
    }
}
