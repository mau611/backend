<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoConsulta;
use Illuminate\Http\Request;

class TipoConsultaController extends Controller
{
    public function index()
    {
        $tipoConsulta = TipoConsulta::all();
        return $tipoConsulta;
    }

    public function store(Request $request)
    {
        $tipoConsulta = new TipoConsulta();
        $tipoConsulta->nombre = $request->nombre;
        $tipoConsulta->color = $request->color;
        $tipoConsulta->save();
    }

    public function show($id)
    {
        $tipoConsulta = TipoConsulta::find($id);
        return $tipoConsulta;
    }

    public function update(Request $request, $id)
    {
        $tipoConsulta = TipoConsulta::findOrFail($id);
        $tipoConsulta->nombre = $request->nombre;
        $tipoConsulta->color = $request->color;
        $tipoConsulta->save();
        return $tipoConsulta;
    }

    public function destroy($id)
    {
        $tipoConsulta = TipoConsulta::destroy($id);
        return $tipoConsulta;

    }
}
