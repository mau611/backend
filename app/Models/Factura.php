<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'numero', 'total', 'estado_pago', 'forma_pago', 'detalles_pago', 'digitos_tarjeta', 'consulta_id'];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class)->with("paciente")->with("tipoConsulta");
    }
    public function conceptos()
    {
        return $this->hasMany(Concepto::class);
    }
}
