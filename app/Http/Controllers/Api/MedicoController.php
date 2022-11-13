<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::all();
        return $medicos;
    }

    public function store(Request $request)
    {
        $medico = new Medico();
        $medico->nombre = $request->nombre;
        $medico->telefono = $request->telefono;
        $medico->Direccion = $request->Direccion;
        $medico->save();
    }

    public function show($id)
    {
        $medico = Medico::find($id);
        return $medico;
    }

    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail();
        $medico->nombre = $request->nombre;
        $medico->telefono = $request->telefono;
        $medico->Direccion = $request->Direccion;
        $medico->save();
        return $medico;
    }

    public function destroy($id)
    {
        $medico = Medico::destroy($id);
        return $medico;
    }
}
