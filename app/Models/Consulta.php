<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'comentario', 'estado', 'tratamiento', 'paciente_id', 'tipo_consulta_id','profesional_id'];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
    public function tipoConsulta(){
        return $this->belongsTo(TipoConsulta::class);
    }
    public function consultorio(){
        return $this->belongsTo(Consultorio::class);
    }
    public function estadoCita(){
        return $this->belongsTo(EstadoCita::class);
    }
    public function facturas(){
        return $this->hasMany(Factura::class)->with('conceptos');
    } 
    public function quienAgendo(){
        return $this->belongsTo(Profesional::class);
    }
}
