<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bono extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'sesiones', 'precio', 'restantes', 'paciente_id'];

    public function paciente(){
        return $this->belongsTo(Paciente::class, "paciente_id");
    }
}
