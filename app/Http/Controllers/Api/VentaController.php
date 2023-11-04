<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Descuento;
use App\Models\IngresoProducto;
use App\Models\Venta;
use App\Models\VentaIngreso;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with("paciente")->whereDate("fecha", new DateTime("now", new DateTimeZone('America/La_Paz')))->get();
        $total = [];
        $totalFacturacion = 0;
        $efectivo = 0;
        $tranferencias = 0;
        $tarjeta = 0;
        foreach ($ventas as $venta) {
            if ($venta->estado == "Pagado") {
                $totalFacturacion += $venta->total;
                if ($venta->tipo_pago == "Efectivo") {
                    $efectivo += $venta->total;
                } else if ($venta->tipo_pago == "Transferencia") {
                    $tranferencias += $venta->total;
                } else {
                    $tarjeta += $venta->total;
                }
            }
        }
        array_push($total, $totalFacturacion, $efectivo, $tranferencias, $tarjeta);
        return [$ventas, $total];
    }

    public function store(Request $request)
    {
        $venta = new Venta();
        $date = new DateTime("now", new DateTimeZone('America/La_Paz'));
        $venta->fecha = $date->format('Y-m-d');
        $venta->numero = (int)$date->format('dmHi');
        $venta->total = $request->total;
        $venta->estado = $request->estado;
        $venta->tipo_pago = $request->tipo_pago;
        $venta->detalles_pago = $request->detalles_pago;
        $venta->observaciones = $request->observaciones;
        $venta->paciente_id = (int)explode(" ", $request->paciente_id)[0];
        $venta->profesional_id = (int)explode(" ", $request->profesional_id)[0];
        $venta->digitos_tarjeta = $request->digitos_tarjeta;
        $venta->save();
        $repeticiones = array_count_values($request->productos);
        $productos = array_unique($request->productos);
        foreach ($productos as $producto) {
            $ventaIngreso = new VentaIngreso();
            $ingreso = IngresoProducto::with("producto")->find($producto);
            $descuento = Descuento::where([
                ['activo', '=', 1],
                ["producto", '=', 1],
                ["paciente_id", '=', (int)explode(" ", $request->paciente_id)[0]],
                ["serv_o_prod_id", '=', $ingreso->producto->id],
            ])->first();
            $ingreso->cantidad = $ingreso->cantidad - $repeticiones[$producto];
            if ($descuento != null) {
                if ($descuento->porcentaje) {
                    $ventaIngreso->subtotal = ($ingreso->PrecioVenta - ($ingreso->PrecioVenta * ($descuento->cantidad_descuento / 100))) * $repeticiones[$producto];
                } else {
                    $ventaIngreso->subtotal = $descuento->cantidad_descuento * $repeticiones[$producto];
                }
                $ventaIngreso->cantidad = $repeticiones[$producto];
                $ventaIngreso->ingreso_id = $ingreso->id;
                $ventaIngreso->venta_id = $venta->id;
                $ventaIngreso->save();
                $ingreso->save();
            } else {
                $ventaIngreso->subtotal = $ingreso->PrecioVenta * $repeticiones[$producto];
                $ventaIngreso->cantidad = $repeticiones[$producto];
                $ventaIngreso->ingreso_id = $ingreso->id;
                $ventaIngreso->venta_id = $venta->id;
                $ventaIngreso->save();
                $ingreso->save();
            }
        }
    }

    public function show($id)
    {
        $venta = Venta::find($id);
        return $venta;
    }

    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->fecha = $request->fecha;
        $venta->numero = $request->numero;
        $venta->total = $request->total;
        $venta->estado = $request->estado;
        $venta->tipo_pago = $request->tipo_pago;
        $venta->detalles_pago = $request->detalles_pago;
        $venta->observaciones = $request->observaciones;
        $venta->save();
        return $venta;
    }

    public function destroy($id)
    {
        $venta = Venta::destroy($id);
        return $venta;
    }
}
