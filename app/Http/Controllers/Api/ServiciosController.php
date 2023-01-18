<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return $servicios;
    }

    public function store(Request $request)
    {
        $servicio = new Servicio();
        $servicio->servicio = $request->servicio;
        $servicio->costo = $request->costo;
        $servicio->save();
    }

    public function show($id)
    {
        $servicio = Servicio::find($id);
        return $servicio;
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::find($id);
        $servicio->servicio = $request->servicio;
        $servicio->costo = $request->costo;
        $servicio->save();
    }

    public function destroy($id)
    {
        $servicio = Servicio::destroy($id);
        return $servicio;
    }
}
