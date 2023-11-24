<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = ['nombres', 'apellidos', 'telefono', 'fecha_nacimiento', 'ci', 'sexo', 'direccion', 'referencia', 'fecha_registro'];

    public function citas()
    {
        return $this->hasMany(Consulta::class)->with("historias")->with('consultorio')->with("facturas")->with("documentos")->with("indicacionesMedicas")->with("fotosControl")->with("examenesMedicos")->with("consentimientosInformados")->with("tipoConsulta");
    }
    public function bonos()
    {
        return $this->hasMany(Bono::class);
    }
    public function compras()
    {
        return $this->hasMany(Venta::class);
    }
    public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class)->with('tratamientos');
    }
    public function descuentos()
    {
        return $this->hasMany(Descuento::class);
    }
}
