<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;
    protected $fillable = ['diagnostico', 'fecha', 'paciente_id'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class)->with("user");
    }
}
