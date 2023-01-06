<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoProducto extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'PrecioCompra', 'PrecioVenta', 'cantidad', 'producto_id'];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
