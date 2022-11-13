<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profesional;
use Illuminate\Http\Request;

class ProfesionalController extends Controller
{
    public function index()
    {
        $profesionales = Profesional::all();
        return $profesionales;
    }

    public function store(Request $request)
    {
        $profesional = new Profesional();
        $profesional->nombre = $request->nombre;
        $profesional->save();
    }

    public function show($id)
    {
        $profesional = Profesional::find($id);
        return $profesional;
    }

    public function update(Request $request, $id)
    {
        $profesional = Profesional::findOrFail($request->id);
        $profesional->nombre = $request->nombre;
        $profesional->save();
        return $profesional;
    }

    public function destroy($id)
    {
        $profesionales = Profesional::destroy($id);
        return $profesionales;
    }
}
