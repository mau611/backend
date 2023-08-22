<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCitaRequest;
use App\Models\Consulta;
use App\Models\EstadoCita;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with("paciente")
                             ->with("tipoConsulta")
                             ->with("consultorio")
                             ->with("estadoCita")
                             ->with("facturas")->get();
        return $consultas;
    }

    public function store(StoreCitaRequest $datos)
    {
        $request = $datos->validated();
        $consulta = new Consulta;
        $consulta->title = $request->title;
        $consulta->start = $request->start;
        $consulta->end = $request->end;
        $consulta->paciente_id = $request->paciente_id;
        $consulta->tipo_consulta_id = $request->tipoConsulta_id;
        $consulta->consultorio_id = $request->id;
        $consulta->estado_cita_id = $request->estadoConsulta_id;
        $consulta->profesional_id = $request->profesional_id;
        $consulta->save();
    }

    public function show($id)
    {
        $consulta = Consulta::find($id);
        return $consulta;
    }

    public function update(Request $request, $id)
    {
        $consulta = Consulta::findOrFail($request->id);
        $consulta->start = $request->start;
        $consulta->end = $request->end;
        $consulta->consultorio_id = $request->resourceId;
        $consulta->save();
        return $consulta;
    }

    public function updateEstado(Request $request, $id, $eId)
    {
        $consulta = Consulta::findOrFail($request->id);
        $estado = EstadoCita::findOrFail($request->eId);
        $consulta->estado_cita_id = $estado->id;
        $consulta->save();
        return $consulta;
    }

    public function destroy($id)
    {
        $consulta = Consulta::destroy($id);
        return $consulta;
    }
}
