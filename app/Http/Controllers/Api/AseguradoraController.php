<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aseguradora;
use Illuminate\Http\Request;

class AseguradoraController extends Controller
{
    public function index()
    {
        $aseguradoras = Aseguradora::all();
        return $aseguradoras;
    }

    public function store(Request $request)
    {
        $aseguradora = new Aseguradora();
        $aseguradora->nombre = $request->nombre;
        $aseguradora->save();
    }

    public function show($id)
    {
        $aseguradora = Aseguradora::find($id);
        return $aseguradora;
    }

    public function update(Request $request, $id)
    {
        $aseguradora = Aseguradora::findOrFail($request->$id);
        $aseguradora->nombre = $request->nombre;
        $aseguradora->save();
        return $aseguradora;
    }

    public function destroy($id)
    {
        $aseguradora = Aseguradora::destroy($id);
        return $aseguradora;
    }
}
