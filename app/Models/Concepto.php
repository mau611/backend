<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'cantidad', 'precio', 'subtotal', 'factura_id'];

    public function factura(){
        return $this->belongsTo(Factura::class);
    }
}
