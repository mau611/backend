<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosUso extends Model
{
    use HasFactory;
    protected $fillable = ['productos_uso'];

    public function ingresosUso()
    {
        return $this->hasMany(IngresoProductoUso::class)->with("consumos");
    }
}
