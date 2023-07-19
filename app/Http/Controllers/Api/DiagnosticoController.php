<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diagnostico;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosticos = Diagnostico::all();
        return $diagnosticos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diagnostico = new Diagnostico;
        $diagnostico->diagnostico = $request->diagnostico;
        $diagnostico->fecha = date('Y-m-d');
        $diagnostico->paciente_id = $request->paciente_id;
        $diagnostico->save();
        return $diagnostico;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnostico = Diagnostico::find($id);
        return $diagnostico;
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
        $diagnostico = Diagnostico::findOrFail($request->id);
        $diagnostico->diagnostico = $request->diagnostico;
        $diagnostico->save();
        return $diagnostico;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnostico = Diagnostico::destroy($id);
        return $diagnostico;
    }
}
