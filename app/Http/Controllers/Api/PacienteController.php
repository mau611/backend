<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with("bonos")->with("citas")->get();
        return $pacientes;
    }

    public function store(Request $request)
    {
        $paciente = new Paciente();
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->telefono = $request->telefono;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->ci = $request->ci;
        $paciente->sexo = $request->sexo;
        $paciente->direccion = $request->direccion;
        $paciente->fecha_registro = $request->fecha_registro;
        $paciente->save();
    }

    public function show($id)
    {
        $paciente = Paciente::find($id);
        return $paciente;

    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::FindOrFail($request->id);
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->telefono = $request->telefono;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->ci = $request->ci;
        $paciente->sexo = $request->sexo;
        $paciente->direccion = $request->direccion;
        $paciente->fecha_registro = $request->fecha_registro;
        $paciente->save();
        return $paciente;
    }

    public function destroy($id)
    {
        $paciente = Paciente::destroy($id);
        return $paciente;

    }
}
