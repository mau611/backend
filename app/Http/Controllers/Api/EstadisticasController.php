<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Factura;
use App\Models\IngresoProducto;
use App\Models\ProductosUso;
use App\Models\Venta;
use App\Models\VentaIngreso;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function estadisticaAsistenciasPorArea($areaId, $desde, $hasta)
    {
        $total = [];
        $totalFacturacion = 0;
        $efectivo = 0;
        $tranferencias = 0;
        $qr = 0;
        $tarjeta = 0;
        $facturas = new Collection();
        if ($areaId == "Todos") {
            $facturas = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
        } else if ($areaId != "Todos") {
            $facturasAux = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
            foreach ($facturasAux as $factura) {
                if ($factura->consulta->consultorio->area->id == $areaId) {
                    $facturas->push($factura);
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
    public function estadisticaConsultas($pacienteId, $citaId, $desde, $hasta)
    {
        $total = [];
        $totalFacturacion = 0;
        $efectivo = 0;
        $tranferencias = 0;
        $qr = 0;
        $tarjeta = 0;
        $facturas = new Collection();
        if ($pacienteId == "Todos" && $citaId == "Todos") {
            $facturas = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
        } else {
            if ($pacienteId != "Todos" && $citaId == "Todos") {
                $facturasAux = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
                foreach ($facturasAux as $factura) {
                    if ($factura->consulta->paciente->id == $pacienteId) {
                        $facturas->push($factura);
                    }
                }
            }
            if ($pacienteId == "Todos" && $citaId != "Todos") {
                $facturasAux = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
                foreach ($facturasAux as $factura) {
                    if ($factura->consulta->tipo_consulta_id == $citaId) {
                        $facturas->push($factura);
                    }
                }
            }
            if ($pacienteId != "Todos" && $citaId != "Todos") {
                $facturasAux = Factura::with("consulta")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
                foreach ($facturasAux as $factura) {
                    if ($factura->consulta->tipo_consulta_id == $citaId && $factura->consulta->paciente->id == $pacienteId) {
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
    public function estadisticaVentas($pacienteId, $desde, $hasta)
    {
        $total = [];
        $totalFacturacion = 0;
        $efectivo = 0;
        $tranferencias = 0;
        $qr = 0;
        $tarjeta = 0;
        $ventas = new Collection();
        $vent = [];
        if ($pacienteId == "Todos") {
            $ventas = Venta::with("paciente")->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
        } else {
            $ventas = Venta::with("paciente")->where("paciente_id", $pacienteId)->whereBetween("fecha", [$desde, $hasta])->orderBy("fecha", "asc")->get();
        }
        foreach ($ventas as $venta) {
            $auxVentas = [];
            array_push($auxVentas, $venta);
            array_push($auxVentas, $venta->productos($venta->id));
            array_push($vent, $auxVentas);
            if ($venta->estado == "Pagado") {
                $totalFacturacion += $venta->total;
                if ($venta->tipo_pago == "Efectivo") {
                    $efectivo += $venta->total;
                } else if ($venta->tipo_pago == "Transferencia") {
                    $tranferencias += $venta->total;
                } else if ($venta->tipo_pago == "Qr") {
                    $qr += $venta->total;
                } else if ($venta->tipo_pago == "Tarjeta") {
                    $tarjeta += $venta->total;
                }
            }
        }
        array_push($total, $totalFacturacion, $efectivo, $tranferencias, $qr, $tarjeta);
        return [$ventas, $total, $vent];
    }

    public function estadisticaConsumoStock($productoId)
    {
        $productoUso = ProductosUso::where("id", $productoId)->with("ingresosUso")->first();
        return $productoUso;
    }
}
