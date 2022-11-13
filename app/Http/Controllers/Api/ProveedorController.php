<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return $proveedores;
    }

    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->save();
    }

    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        return $proveedor;
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->nombre = $request->nombre;
        $proveedor->save();
        return $proveedor;
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::destroy($id);
        return $proveedor;
    }
}
