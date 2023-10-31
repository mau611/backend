<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumoUso extends Model
{
    use HasFactory;
    protected $fillable = ["fecha", "ingreso_producto_uso_id"];

    public function ingreso()
    {
        return $this->belongsTo(IngresoProductoUso::class);
    }
}
