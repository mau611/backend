<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'color'];

    public function citas(){
        return $this->hasMany(Consulta::class);
    }
}
