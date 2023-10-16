<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Consulta;
use App\Models\Factura;
use App\Models\IngresoProducto;
use App\Models\VentaIngreso;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'numero', 'total', 'estado', 'tipo_pago', 'detalles_pago', 'observaciones', 'digitos_tarjeta', 'paciente_id', 'profesional_id'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function productos($id)
    {
        $productos = new Collection();
        $ventaIngresos = VentaIngreso::where("venta_id", $id)->get();
        foreach ($ventaIngresos as $ventaIngreso) {
            $ingreso = IngresoProducto::with("producto")->find($ventaIngreso->ingreso_id);
            $productos->push($ingreso->producto);
        }
        return $productos;
    }
}
