<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bono;
use App\Models\Factura;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class BonosController extends Controller
{
    public function index()
    {
        $bonos = Bono::all();
        return $bonos;
    }

    public function store(Request $request)
    {
        $bono = new Bono();
        $bono->nombre = $request->nombre;
        $bono->sesiones = $request->sesiones;
        $bono->precio = $request->precio;
        $bono->restantes = $request->restantes;
        $bono->paciente_id = $request->paciente_id;
        $bono->save();
    }

    public function show($id)
    {
        $bono = Bono::find($id);
        return $bono;
    }

    public function update(Request $request, $id)
    {
        $bono = Bono::findOrFail($request->$id);
        $bono->nombre = $request->nombre;
        $bono->sesiones = $request->sesiones;
        $bono->precio = $request->precio;
        $bono->restantes = $request->restantes;
        $bono->paciente_id = $request->paciente_id;

        $bono->save();
        return $bono;
    }
    public function descontar(Request $request, $id)
    {
        $bono = Bono::findOrFail($request->bono_id);
        $bono->restantes -= 1;
        $factura = new Factura();
        $date = new DateTime("now", new DateTimeZone('America/La_Paz'));
        $factura->fecha = $date->format('Y-m-d');
        $factura->numero = (int)$date->format("dmHi");
        $factura->total = 0;
        $factura->estado_pago = "pagado";
        $factura->forma_pago = "efectivo";
        $factura->detalles_pago = strval($bono->sesiones-$bono->restantes) . "/" . strval($bono->sesiones) ." sesiones ".$bono->nombre;
        $factura->consulta_id = $request->consulta_id;
        $bono->save();
        $factura->save();
        return $bono;
    }

    public function destroy($id)
    {
        $bono = Bono::destroy($id);
        return $bono;
    }
}
