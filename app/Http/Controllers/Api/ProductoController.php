<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IngresoProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with("proveedor")->with("ingresos")->get();
        return $productos;
    }

    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->proveedor_id = $request->proveedor;
        $producto->save();
        $ingreso = new IngresoProducto();
        $ingreso->fecha = $request->fechaIngreso;
        $ingreso->PrecioCompra = $request->precioCompra;
        $ingreso->PrecioVenta = $request->precioVenta;
        $ingreso->cantidad = $request->cantidad;
        $ingreso->producto_id = $producto->id;
        $ingreso->save();
    }

    public function show($id)
    {
        $producto = Producto::find($id);
        return $producto;
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->proveedor_id = $request->proveedor_id;
        $producto->save();
        return $producto;
    }

    public function destroy($id)
    {
        $producto = Producto::destroy($id);
        return $producto;
    }
}
