<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $fillable = ['evaluacion_objetiva', 'evaluacion_subjetiva' , 'evolucion' , 'consulta_id'];

    public function consulta(){
        return $this->belongsTo(Consulta::class);
    }
}
