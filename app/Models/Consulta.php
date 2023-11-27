<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'comentario', 'estado', 'tratamiento', 'paciente_id', 'tipo_consulta_id', 'profesional_id'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class)->with('bonos')->with("descuentos");
    }
    public function tipoConsulta()
    {
        return $this->belongsTo(TipoConsulta::class);
    }
    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class)->with("area");
    }
    public function estadoCita()
    {
        return $this->belongsTo(EstadoCita::class);
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class)->with('conceptos');
    }
    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }
    public function historias()
    {
        return $this->hasMany(Historial::class)->with('user');
    }
    public function documentos()
    {
        return $this->hasMany(DocumentoConsulta::class);
    }
    public function indicacionesMedicas()
    {
        return $this->hasMany(IndicacionesMedicas::class);
    }
    public function fotosControl()
    {
        return $this->hasMany(FotosControl::class);
    }
    public function examenesMedicos()
    {
        return $this->hasMany(ExamenesMedicos::class);
    }
    public function consentimientosInformados()
    {
        return $this->hasMany(ConsentimientosInformados::class);
    }
}
