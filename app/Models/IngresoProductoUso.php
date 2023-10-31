<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoProductoUso extends Model
{
    use HasFactory;
    protected $fillable = ['fecha_ingreso', 'existencias', 'producto_uso'];

    public function producto()
    {
        return $this->belongsTo(ProductosUso::class);
    }
    public function consumos()
    {
        return $this->hasMany(ConsumoUso::class);
    }
}
