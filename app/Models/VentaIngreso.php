<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaIngreso extends Model
{
    use HasFactory;
    protected $fillable = ['subtotal', 'cantidad', 'ingreso_id', 'venta_id'];
}
