<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Factura;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{

    public function estadisticaAsistencias($citaId, $consultorioId, $desde, $hasta)
    {
        $total = [];
        $totalFacturacion = 0;
        $efectivo = 0;
        $tranferencias = 0;
        $qr = 0;
        $tarjeta = 0;
        $facturas = new Collection();
        if ($citaId == "Todos" && $consultorioId == "Todos") {
            $facturas = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
        } else {
            if ($citaId != "Todos" && $consultorioId == "Todos") {
                $facturasAux = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
                foreach ($facturasAux as $factura) {
                    if ($factura->consulta->tipo_consulta_id == $citaId) {
                        $facturas->push($factura);
                    }
                }
            }
            if ($citaId == "Todos" && $consultorioId != "Todos") {
                $facturasAux = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
                foreach ($facturasAux as $factura) {
                    if ($factura->consulta->consultorio_id == $consultorioId) {
                        $facturas->push($factura);
                    }
                }
            }
            if ($citaId != "Todos" && $consultorioId != "Todos") {
                $facturasAux = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
                foreach ($facturasAux as $factura) {
                    if ($factura->consulta->consultorio_id == $consultorioId && $factura->consulta->consultorio_id == $consultorioId) {
                        $facturas->push($factura);
                    }
                }
            }
        }

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
}
