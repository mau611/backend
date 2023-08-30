<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Concepto;
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
        $tarjetaDebito = 0;
        $tarjetaCredito = 0;

        foreach ($facturas as $factura) {
            if ($factura->estado_pago == "pagado") {
                $totalFacturacion += $factura->total;
                if ($factura->forma_pago == "Efectivo") {
                    $efectivo += $factura->total;
                } else if ($factura->forma_pago == "Transferencia") {
                    $tranferencias += $factura->total;
                } else if ($factura->forma_pago == "Qr") {
                    $qr += $factura->total;
                } else if ($factura->forma_pago == "Tarjeta de Debito") {
                    $tarjetaDebito += $factura->total;
                } else if ($factura->forma_pago == "Tarjeta de Credito") {
                    $tarjetaCredito += $factura->total;
                }
            }
        }
        array_push($total, $totalFacturacion, $efectivo, $tranferencias, $qr, $tarjetaDebito, $tarjetaCredito);
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
        $factura->save();
        foreach ($request->tratamientos as $tratamiento) {
            $servicio = Servicio::find((int)$tratamiento);
            $concepto = new Concepto();
            $concepto->nombre = $servicio->servicio;
            $concepto->cantidad = 1;
            $concepto->precio = $servicio->costo;
            $concepto->subtotal = $servicio->costo * 1;
            $concepto->factura_id = $factura->id;
            $concepto->save();
        }
        return $factura;
    }

    public function show($id)
    {
        $factura = Factura::find($id);
        return $factura;
    }

    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($request->id);
        $factura->fecha = $request->fecha;
        $factura->numero = $request->numero;
        $factura->total = $request->total;
        $factura->estado_pago = $request->estado_pago;
        $factura->forma_pago = $request->forma_pago;
        $factura->detalles_pago = $request->detalles_pago;
        $factura->consulta_id = $request->consulta_id;
        $factura->save();
        return $factura;
    }

    public function destroy($id)
    {
        $factura = Factura::destroy($id);
        return $factura;
    }
}
