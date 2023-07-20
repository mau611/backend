<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Historial;
use App\Models\Diagnostico;
use Illuminate\Http\Request;

class HistorialController extends Controller
{   
    public function index()
    {
        $historias = Historial::all();
        return $historias;
    }

    public function store(Request $request)
    {
        $historia = new Historial;
        if(strcmp($request->opcion,"nueva")==0){
            $diagnostico = new Diagnostico;
            $diagnostico->diagnostico = $request->diagnostico;
            $diagnostico->fecha =  date('Y-m-d');
            $diagnostico->paciente_id = $request->paciente_id;
            $diagnostico->save();
            $historia->evaluacion_objetiva = $request->evaluacion_objetiva;
            $historia->evaluacion_subjetiva = $request->evaluacion_subjetiva;
            $historia->evolucion = "";
        }else{
            $historia->evaluacion_objetiva = "";
            $historia->evaluacion_subjetiva = "";
            $historia->evolucion = $request->evolucion;
        }
        $historia->consulta_id = $request->consulta_id;
        $historia->save();
        return "exito al guardar";
    }

    public function show($id)
    {
        $historia = Historial::find($id);
        return $historia;
    }

    public function update(Request $request, $id)
    {
        $historia = Historial::findOrFail();
        $historia->nombre = $request->nombre;        
        $historia->consulta_id = $request->consulta_id;  
        $historia->save();
        return $historia;
    }

    public function destroy($id)
    {
        $historia = Historial::destroy($id);
        return $historia;
    }
}
