<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Descuento;
use Illuminate\Http\Request;

class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descuentos = Descuento::all();
        return $descuentos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $descuento = new Descuento();
        $descuento->descripcion = $request->descripcion;
        $descuento->porcentaje = $request->porcentaje;
        $descuento->cantidad_descuento = $request->cantidad_descuento;
        $descuento->conCaducidad = $request->conCaducidad;
        $descuento->fecha_caducidad = $request->fecha_caducidad;
        $descuento->producto = $request->producto;
        $descuento->servicio = $request->servicio;
        $descuento->serv_o_prod_id = $request->serv_o_prod_id;
        $descuento->paciente_id = $request->paciente_id;
        $descuento->activo = true;
        $descuento->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
