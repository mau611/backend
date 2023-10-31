<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Profesional;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfesionalPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('profesional_paciente')->insert([
            [
                'paciente_id' => $request->paciente_id,
                'profesional_id' => $request->profesional_id
            ],
        ]);
    }

    public function getProfesionales($pacId)
    {
        $profesionales_pacientes = DB::table('profesional_paciente')->where("paciente_id", $pacId)->get();
        $profesionales = new Collection();
        foreach ($profesionales_pacientes as $prof_pac) {
            $profesional = Profesional::find($prof_pac->profesional_id);
            $profesionales->push($profesional);
        }
        return $profesionales;
    }
    public function getPacientes($profId)
    {
        $pacientes_profesionales = DB::table('profesional_paciente')->where("profesional_id", $profId)->get();
        $pacientes = new Collection();
        foreach ($pacientes_profesionales as $pac_prof) {
            $paciente = Paciente::where("id", "=", $pac_prof->paciente_id)->with("diagnosticos")->first();
            $pacientes->push($paciente);
        }
        return $pacientes;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
