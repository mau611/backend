<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tratamientos = Tratamiento::all();
        return $tratamientos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tratamiento = new Tratamiento;
        $tratamiento->tratamiento = $request->tratamiento;
        $tratamiento->fecha = date('Y-m-d');
        $tratamiento->diagnostico_id = $request->diagnostico_id;
        $tratamiento->user_id = $request->user_id;
        $tratamiento->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tratamiento = Tratamiento::find($id);
        return $tratamiento;
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
        $tratamiento = Tratamiento::findOrFail($request->id);
        $tratamiento->observacion = $request->observacion;
        $tratamiento->diagnostico_id = $request->diagnostico_id;
        $tratamiento->save();
        return $tratamiento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tratamiento = Tratamiento::destroy($id);
        return $tratamiento;
    }
}
