<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'proveedor_id'];

    public function ingresos(){
        return $this->hasMany(IngresoProducto::class);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
}
