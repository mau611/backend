<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Profesional;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::get();
        return $pacientes;
    }

    public function store(StorePacienteRequest $datos)
    {
        $request = $datos->validated();
        $paciente = new Paciente();
        $paciente->nombres = $request['nombres'];
        $paciente->apellidos = $request['apellidos'];
        $paciente->telefono = $request['telefono'];
        $paciente->fecha_nacimiento = $request['fecha_nacimiento'];
        $paciente->ci = $request['ci'];
        $paciente->sexo = $request['sexo'];
        $paciente->direccion = $request['direccion'];
        $paciente->fecha_registro = $request['fecha_registro'];
        $paciente->save();
    }

    public function show($id)
    {
        $paciente = Paciente::where("id","=",$id)->with("bonos")->with("citas")->with("diagnosticos")->first();
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

    public function agregarProfesional($paciente_id, $profesional_id){
        return DB::table('profesional_paciente')->insert([
            [
                'paciente_id' => $paciente_id, 
                'profesional_id' => $profesional_id
            ],
        ]);
    }
    public function profesionales($id){
        $profsIds = DB::table('profesional_paciente')->where('paciente_id', $id)->get();
        $profesionales = array();
        foreach($profsIds as $profId){
            $profesional = Profesional::findOrFail($profId->profesional_id);
            array_push($profesionales, $profesional);
        }
        return $profesionales;
    }
}
