<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Concepto;
use App\Models\Consulta;
use App\Models\Descuento;
use App\Models\Factura;
use App\Models\Servicio;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with("consulta")->whereDate("fecha", new DateTime("now", new DateTimeZone('America/La_Paz')))->get();
        $total = [];
        $totalFacturacion = 0;
        $efectivo = 0;
        $tranferencias = 0;
        $qr = 0;
        $tarjeta = 0;

        foreach ($facturas as $factura) {
            if ($factura->estado_pago == "pagado") {
                $totalFacturacion += $factura->total;
                if ($factura->forma_pago == "Efectivo") {
                    $efectivo += $factura->total;
                } else if ($factura->forma_pago == "Transferencia") {
                    $tranferencias += $factura->total;
                } else if ($factura->forma_pago == "Qr") {
                    $qr += $factura->total;
                } else if ($factura->forma_pago == "Tarjeta") {
                    $tarjeta += $factura->total;
                }
            }
        }
        array_push($total, $totalFacturacion, $efectivo, $tranferencias, $qr, $tarjeta);
        return [$facturas, $total];
    }

    public function store(Request $request)
    {
        $factura = new Factura();
        $date = new DateTime("now", new DateTimeZone('America/La_Paz'));
        $factura->fecha = $date->format('Y-m-d');
        $factura->numero = (int)$date->format("dmHi");
        $factura->total = $request->total;
        $factura->estado_pago = $request->estado_pago;
        $factura->forma_pago = $request->forma_pago;
        $factura->detalles_pago = $request->detalles_pago;
        $factura->consulta_id = $request->consulta_id;
        $factura->digitos_tarjeta = $request->digitos_tarjeta;
        $factura->save();
        $consulta = Consulta::with("paciente")->find($request->consulta_id);
        foreach ($request->tratamientos as $tratamiento) {
            //$descuento = Descuento::where("activo", true)->where("servicio", true)->where("paciente_id", $consulta->paciente->id)->where("serv_o_prod_id", (int)$tratamiento)->first();
            $descuento = Descuento::where([
                ['activo', '=', 1],
                ["servicio", '=', 1],
                ["paciente_id", '=', $consulta->paciente->id],
                ["serv_o_prod_id", '=', (int)$tratamiento],
            ])->first();
            $servicio = Servicio::find((int)$tratamiento);
            if ($descuento != null) {
                $concepto = new Concepto();
                $concepto->cantidad = 1;
                $concepto->factura_id = $factura->id;
                if ($descuento->porcentaje) {
                    $concepto->nombre = "Se asigno un descuento del " . $descuento->cantidad_descuento . "% ." . $servicio->servicio;
                    $concepto->precio = $servicio->costo - ($servicio->costo * ($descuento->cantidad_descuento / 100));
                    $concepto->subtotal = $servicio->costo - ($servicio->costo * ($descuento->cantidad_descuento / 100));
                } else {
                    $concepto->nombre = "Descuento del servicio con cambio de precio. " . $servicio->servicio;
                    $concepto->precio = $descuento->cantidad_descuento;
                    $concepto->subtotal = $descuento->cantidad_descuento * 1;
                }
                $concepto->save();
            } else {
                $concepto = new Concepto();
                $concepto->nombre = $servicio->servicio;
                $concepto->cantidad = 1;
                $concepto->precio = $servicio->costo;
                $concepto->subtotal = $servicio->costo * 1;
                $concepto->factura_id = $factura->id;
                $concepto->save();
            }
        }
        return $factura;
    }

    public function show($id)
    {
        $factura = Factura::with("conceptos")->with("consulta")->find($id);
        return $factura;
    }
    public function ultimasFacturas($id)
    {
        $citasPaciente = Consulta::where("paciente_id", $id)->orderBy("created_at", "DESC")->with("facturas")->take(5)->get();
        $facturas = [];
        foreach ($citasPaciente as $cita) {
            foreach ($cita->facturas as $factura) {
                array_push($facturas, $factura);
            }
        }
        return $facturas;
    }

    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($id);
        $factura->total = $request->total;
        $factura->estado_pago = $request->estado_pago;
        $factura->forma_pago = $request->forma_pago;
        $factura->detalles_pago = $request->detalles_pago;
        $conceptosBD = $this->show($id)->conceptos;
        foreach ($conceptosBD as $cBD) {
            Concepto::destroy($cBD->id);
        }
        foreach ($request->conceptos as $concepto) {
            $conceptoNuevo = new Concepto();
            $conceptoNuevo->nombre = $concepto["concepto"];
            $conceptoNuevo->cantidad = $concepto["cantidad"];
            $conceptoNuevo->precio = $concepto["precio"];
            $conceptoNuevo->subtotal = ($concepto["precio"]) * ($concepto["cantidad"]);
            $conceptoNuevo->factura_id = $factura->id;
            $conceptoNuevo->save();
        }
        $factura->save();
        return $factura;
    }

    public function destroy($id)
    {
        $factura = Factura::destroy($id);
        return $factura;
    }
}
