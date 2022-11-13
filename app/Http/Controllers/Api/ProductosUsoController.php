<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductosUso;
use Illuminate\Http\Request;

class ProductosUsoController extends Controller
{
    public function index()
    {
        $productosUso = ProductosUso::all();
        return $productosUso;
    }

    public function store(Request $request)
    {
        $productoUso = new ProductosUso();
        $productoUso->productos_uso = $request->productos_uso;
        $productoUso->fecha_ingreso = $request->fecha_ingreso;
        $productoUso->existencias = $request->existencias;
        $productoUso->save();
    }

    public function show($id)
    {
        $productoUso = ProductosUso::find($id);
        return $productoUso;
        
    }

    public function update(Request $request, $id)
    {
        $productoUso = ProductosUso::findOrFail($request->id);
        $productoUso->productos_uso = $request->productos_uso;
        $productoUso->fecha_ingreso = $request->fecha_ingreso;
        $productoUso->existencias = $request->existencias;
        $productoUso->save();
        return $productoUso;
    }

    public function destroy($id)
    {
        $productoUso = ProductosUso::destroy($id);
        return $productoUso;
    }
}
