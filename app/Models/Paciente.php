<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = ['nombres', 'apellidos', 'telefono', 'fecha_nacimiento', 'ci', 'sexo', 'direccion', 'fecha_registro'];

    public function citas(){
        return $this->hasMany(Consulta::class, "paciente_id","paciente_id");
    }
    public function bonos(){
        return $this->hasMany(Bono::class);
    }
    public function compras(){
        return $this->hasMany(Venta::class);
    }
}
