<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bono;
use Illuminate\Http\Request;

class BonosController extends Controller
{
    public function index()
    {
        $bonos = Bono::all();
        return $bonos;
    }

    public function store(Request $request)
    {
        $bono = new Bono();
        $bono->nombre = $request->nombre;
        $bono->sesiones = $request->sesiones;
        $bono->precio = $request->precio;
        $bono->restantes = $request->restantes;
        $bono->paciente_id = $request->paciente_id;

        $bono->save();
    }

    public function show($id)
    {
        $bono = Bono::find($id);
        return $bono;
    }

    public function update(Request $request, $id)
    {
        $bono = Bono::findOrFail($request->$id);
        $bono->nombre = $request->nombre;
        $bono->sesiones = $request->sesiones;
        $bono->precio = $request->precio;
        $bono->restantes = $request->restantes;
        $bono->paciente_id = $request->paciente_id;

        $bono->save();
        return $bono;
    }

    public function destroy($id)
    {
        $bono = Bono::destroy($id);
        return $bono;
    }
}
