<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicoPacienteController extends Controller
{
    public function store(Request $request)
    {
        DB::table('medico_paciente')->insert([
            [
                'medico_id' => $request->medico_id,
                'paciente_id' => $request->paciente_id
            ],
        ]);
    }

    public function getMedicos($pacId)
    {
        $medicos_pacientes = DB::table('medico_paciente')->where("paciente_id", $pacId)->get();
        $medicos = new Collection();
        foreach ($medicos_pacientes as $med_pac) {
            $medico = Medico::find($med_pac->medico_id);
            $medicos->push($medico);
        }
        return $medicos;
    }
}
