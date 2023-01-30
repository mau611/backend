<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'numero', 'total', 'estado_pago', 'forma_pago', 'detalles_pago', 'consulta_id'];

    public function consulta(){
        return $this->belongsTo(Consulta::class);
    }
}
