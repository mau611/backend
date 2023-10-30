<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'ficha'];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
