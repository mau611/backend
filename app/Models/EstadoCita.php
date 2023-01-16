<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCita extends Model
{
    protected $fillable = ['estado'];
    use HasFactory;

    public function citas(){
        return $this->hasMany(Consulta::class);
    }
}
