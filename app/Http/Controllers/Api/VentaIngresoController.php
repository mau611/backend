<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IngresoProducto;
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
        $ventaIngreso = new IngresoProducto();
        $ventaIngreso->fecha = $request->fecha;
        $ventaIngreso->PrecioCompra = $request->PrecioCompra;
        $ventaIngreso->PrecioVenta = $request->PrecioVenta;
        $ventaIngreso->cantidad = $request->cantidad;
        $ventaIngreso->factura = $request->factura;
        $ventaIngreso->vencimiento = $request->vencimiento;
        $ventaIngreso->producto_id = $request->producto_id;
        $ventaIngreso->save();
    }

    public function show($id)
    {
        $ventaIngreso = IngresoProducto::find($id);
        return  $ventaIngreso;
    }

    public function update(Request $request, $id)
    {
        $ventaIngreso = IngresoProducto::findOrFail($id);
        $ventaIngreso->PrecioCompra = $request->PrecioCompra;
        $ventaIngreso->PrecioVenta = $request->PrecioVenta;
        $ventaIngreso->cantidad = $request->cantidad;
        $ventaIngreso->factura = $request->factura;
        $ventaIngreso->fecha = $request->fecha;
        $ventaIngreso->vencimiento = $request->vencimiento;
        $ventaIngreso->save();
    }

    public function destroy($id)
    {
        //
    }
}
