<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function citasAgendadas(){
        return $this->hasMany(Consulta::class);
    }
}
