<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;
    protected $fillable = ["descripcion", "porcentaje", "cantidad_descuento", "activo", "conCaducidad", "fecha_caducidad", "producto", "servicio", "serv_o_prod_id", "paciente_id"];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
