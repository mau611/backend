<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    public function index()
    {
        $consultorios = Consultorio::all();
        return $consultorios;
    }

    public function consultorioPorArea($id)
    {
        $consultorios = Consultorio::where("area_id", $id)->get();
        return $consultorios;
    }

    public function store(Request $request)
    {
        $consultorio = new Consultorio;
        $consultorio->nombre = $request->nombre;
        $consultorio->area_id = $request->area_id;
        $consultorio->save();
    }

    public function show($id)
    {
        $consultorio = Consultorio::find($id);
        return $consultorio;
    }

    public function update(Request $request, $id)
    {
        $consultorio = Consultorio::findOrFail($request->id);
        $consultorio->nombre = $request->nombre;
        $consultorio->area_id = $request->area_id;
        $consultorio->save();
        return $consultorio;
    }

    public function destroy($id)
    {
        $consultorio = Consultorio::destroy($id);
        return $consultorio;
    }
}
