<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{

    public function index()
    {
        $productos = Almacen::all();
        return $productos;
    }


    public function store(Request $request)
    {
        //'nombre', 'descripcion', 'precioCompra', 'fechaIngreso', 'existencias'
        $producto = new Almacen();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precioCompra = $request->precioCompra;
        $producto->fechaIngreso = $request->fechaIngreso;
        $producto->existencias = $request->existencias;
        $producto->save();
    }

    public function show($id)
    {
        $producto = Almacen::find($id);
        return $producto;
    }

    public function update(Request $request, $id)
    {
        $producto = Almacen::findOrFail($request->id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precioCompra = $request->precioCompra;
        $producto->fechaIngreso = $request->fechaIngreso;
        $producto->existencias = $request->existencias;
        $producto->save();
        return $producto;
    }

    public function descontar(Request $request)
    {
        $producto = Almacen::findOrFail($request->id);
        if ($producto->existencias > 0) {
            $producto->existencias = $producto->existencias - 1;
        }
        $producto->save();
        return $producto;
    }

    public function destroy($id)
    {
        $producto = Almacen::destroy($id);
        return $producto;
    }
}
