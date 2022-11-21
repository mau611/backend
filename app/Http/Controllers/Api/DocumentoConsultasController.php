<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentoConsulta;
use Illuminate\Http\Request;

class DocumentoConsultasController extends Controller
{
    public function index()
    {
        $documentosConsultas = DocumentoConsulta::all();
        return $documentosConsultas;
    }

    public function store(Request $request)
    {
        $documentoConsulta = new DocumentoConsulta();
        $documentoConsulta->nombre = $request->nombre;
        $documentoConsulta->consulta_id = $request->consulta_id;
        $documentoConsulta->save();
    }

    public function show($id)
    {
        $documentoConsulta = DocumentoConsulta::find($id);
        return $documentoConsulta;
    }

    public function update(Request $request, $id)
    {
        $documentoConsulta = DocumentoConsulta::findOrFail($request->id);
        $documentoConsulta->nombre = $request->nombre;
        $documentoConsulta->consulta_id = $request->consulta_id;
        $documentoConsulta->save();
        return $documentoConsulta;
    }

    public function destroy($id)
    {
        $documentoConsulta = DocumentoConsulta::destroy($id);
        return $documentoConsulta; 
    }
}
