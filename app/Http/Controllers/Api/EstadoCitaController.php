<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoCita;
use Illuminate\Http\Request;

class EstadoCitaController extends Controller
{
    public function index()
    {
        $estadosCitas = EstadoCita::all();
        return $estadosCitas;
    }

    public function store(Request $request)
    {
        $estadoCita = new EstadoCita;
        $estadoCita->estado = $request->estado;
        $estadoCita->save();
    }

    public function show($id)
    {
        $estadoCita = EstadoCita::find($id);
        return $estadoCita;
    }

    public function update(Request $request, $id)
    {
        $estadoCita = EstadoCita::findOrFail($request->id);
        $estadoCita->estado = $request->estado;
        $estadoCita->save();
        return $estadoCita;
    }

    public function destroy($id)
    {
        $estadoCita = EstadoCita::destroy($id);
        return $estadoCita;
    }
}
