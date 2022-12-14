<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'numero', 'total', 'estado', 'tipo_pago', 'detalles_pago', 'observaciones'];

}
