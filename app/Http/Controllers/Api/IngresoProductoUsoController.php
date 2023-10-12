<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IngresoProductoUso;
use Illuminate\Http\Request;

class IngresoProductoUsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productoUsoIngreso = new IngresoProductoUso();
        $productoUsoIngreso->fecha_ingreso = $request->fecha_ingreso;
        $productoUsoIngreso->existencias = $request->existencias;
        $productoUsoIngreso->precio_compra = $request->precio_compra;
        $productoUsoIngreso->productos_uso_id = $request->productos_uso_id;
        $productoUsoIngreso->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productoUsoIngreso = IngresoProductoUso::find($id);
        return $productoUsoIngreso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productoUsoIngreso = IngresoProductoUso::findOrFail($id);
        $productoUsoIngreso->fecha_ingreso = $request->fecha_ingreso;
        $productoUsoIngreso->existencias = $request->existencias;
        $productoUsoIngreso->precio_compra = $request->precio_compra;
        $productoUsoIngreso->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
