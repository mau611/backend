<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'comentario', 'estado', 'tratamiento', 'paciente_id', 'tipo_consulta_id'];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
