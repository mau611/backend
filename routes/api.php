<?php

use App\Http\Controllers\Api\AlmacenController;
use App\Http\Controllers\Api\AseguradoraController;
use App\Http\Controllers\Api\BonosController;
use App\Http\Controllers\Api\ConceptoController;
use App\Http\Controllers\Api\ConsultaController;
use App\Http\Controllers\Api\FacturaController;
use App\Http\Controllers\Api\GastoController;
use App\Http\Controllers\Api\HistorialController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\ProductosUsoController;
use App\Http\Controllers\Api\ProfesionalController;
use App\Http\Controllers\Api\VentaController;
use App\Models\DocumentoConsulta;
use App\Models\Proveedor;
use App\Models\TipoConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AlmacenController::class)->group(function(){
    Route::get('/inventario','index');
    Route::post('/inventario','store');
    Route::get('/inventario/{id}','show');
    Route::put('/inventario/{id}','update');
    Route::delete('/inventario/{id}','destroy');
});

Route::controller(AseguradoraController::class)->group(function(){
    Route::get('/aseguradora','index');
    Route::post('/aseguradora','store');
    Route::get('/aseguradora/{id}','show');
    Route::put('/aseguradora/{id}','update');
    Route::delete('/aseguradora/{id}','destroy');
});

Route::controller(BonosController::class)->group(function(){
    Route::get('/bonos','index');
    Route::post('/bono','store');
    Route::get('/bono/{id}','show');
    Route::put('/bono/{id}','update');
    Route::delete('/bono/{id}','destroy');
});

Route::controller(ConceptoController::class)->group(function(){
    Route::get('/conceptos','index');
    Route::post('/concepto','store');
    Route::get('/concepto/{id}','show');
    Route::put('/concepto/{id}','update');
    Route::delete('/concepto/{id}','destroy');
});

Route::controller(ConsultaController::class)->group(function(){
    Route::get('/consultas','index');
    Route::post('/consulta','store');
    Route::get('/consulta/{id}','show');
    Route::put('/consulta/{id}','update');
    Route::delete('/consulta/{id}','destroy');
});

Route::controller(DocumentoConsulta::class)->group(function(){
    Route::get('/archivos','index');
    Route::post('/archivo','store');
    Route::get('/archivo/{id}','show');
    Route::put('/archivo/{id}','update');
    Route::delete('/archivo/{id}','destroy');
});

Route::controller(FacturaController::class)->group(function(){
    Route::get('/facturas','index');
    Route::post('/factura','store');
    Route::get('/factura/{id}','show');
    Route::put('/factura/{id}','update');
    Route::delete('/factura/{id}','destroy');
});

Route::controller(GastoController::class)->group(function(){
    Route::get('/gastos','index');
    Route::post('/gasto','store');
    Route::get('/gasto/{id}','show');
    Route::put('/gasto/{id}','update');
    Route::delete('/gasto/{id}','destroy');
});

Route::controller(HistorialController::class)->group(function(){
    Route::get('/historias','index');
    Route::post('/historia','store');
    Route::get('/historia/{id}','show');
    Route::put('/historia/{id}','update');
    Route::delete('/historia/{id}','destroy');
});

Route::controller(MedicoController::class)->group(function(){
    Route::get('/medicos','index');
    Route::post('/medico','store');
    Route::get('/medico/{id}','show');
    Route::put('/medico/{id}','update');
    Route::delete('/medico/{id}','destroy');
});

Route::controller(PacienteController::class)->group(function(){
    Route::get('/pacientes','index');
    Route::post('/paciente','store');
    Route::get('/paciente/{id}','show');
    Route::put('/paciente/{id}','update');
    Route::delete('/paciente/{id}','destroy');
});

Route::controller(ProductoController::class)->group(function(){
    Route::get('/productos','index');
    Route::post('/producto','store');
    Route::get('/producto/{id}','show');
    Route::put('/producto/{id}','update');
    Route::delete('/producto/{id}','destroy');
});

Route::controller(ProductosUsoController::class)->group(function(){
    Route::get('/materiales','index');
    Route::post('/material_uso','store');
    Route::get('/material_uso/{id}','show');
    Route::put('/material_uso/{id}','update');
    Route::delete('/material_uso/{id}','destroy');
});

Route::controller(ProfesionalController::class)->group(function(){
    Route::get('/profesionales','index');
    Route::post('/profesional','store');
    Route::get('/profesional/{id}','show');
    Route::put('/profesional/{id}','update');
    Route::delete('/profesional/{id}','destroy');
});

Route::controller(Proveedor::class)->group(function(){
    Route::get('/proveedores','index');
    Route::post('/proveedor','store');
    Route::get('/proveedor/{id}','show');
    Route::put('/proveedor/{id}','update');
    Route::delete('/proveedor/{id}','destroy');
});

Route::controller(TipoConsulta::class)->group(function(){
    Route::get('/consultas','index');
    Route::post('/consulta','store');
    Route::get('/consulta/{id}','show');
    Route::put('/consulta/{id}','update');
    Route::delete('/consulta/{id}','destroy');
});

Route::controller(VentaController::class)->group(function(){
    Route::get('/ventas','index');
    Route::post('/venta','store');
    Route::get('/venta/{id}','show');
    Route::put('/venta/{id}','update');
    Route::delete('/venta/{id}','destroy');
});