<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::all();
        return $consultas;
    }

    public function store(Request $request)
    {
        $consulta = new Consulta;
        $consulta->fecha = $request->fecha;
        $consulta->comentario = $request->comentario;
        $consulta->estado = $request->estado;
        $consulta->tratamiento = $request->tratamiento;
        $consulta->paciente_id = $request->paciente_id;
        $consulta->tipo_consulta_id = $request->tipo_consulta_id;
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
        $consulta->fecha = $request->fecha;
        $consulta->comentario = $request->comentario;
        $consulta->estado = $request->estado;
        $consulta->tratamiento = $request->tratamiento;
        $consulta->paciente_id = $request->paciente_id;
        $consulta->tipo_consulta_id = $request->tipo_consulta_id;
        $consulta->save();
        return $consulta;
    }

    public function destroy($id)
    {
        $consulta = Consulta::destroy($id);
        return $consulta;
    }
}
