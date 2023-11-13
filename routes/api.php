<?php

use App\Http\Controllers\Api\AlmacenController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AseguradoraController;
use App\Http\Controllers\Api\BonosController;
use App\Http\Controllers\Api\ConceptoController;
use App\Http\Controllers\Api\ConsultaController;
use App\Http\Controllers\Api\ConsultorioController;
use App\Http\Controllers\Api\DescuentoController;
use App\Http\Controllers\Api\EstadoCitaController;
use App\Http\Controllers\Api\FacturaController;
use App\Http\Controllers\Api\GastoController;
use App\Http\Controllers\Api\HistorialController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\DiagnosticoController;
use App\Http\Controllers\Api\EstadisticasController;
use App\Http\Controllers\Api\FichaMedicaController;
use App\Http\Controllers\Api\TratamientoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\ProductosUsoController;
use App\Http\Controllers\Api\ProfesionalController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\TipoConsultaController;
use App\Http\Controllers\Api\IngresoProductoController;
use App\Http\Controllers\Api\ServiciosController;
use App\Http\Controllers\Api\VentaController;
use App\Http\Controllers\Api\ImportarDatosController;
use App\Http\Controllers\Api\IngresoProductoUsoController;
use App\Http\Controllers\Api\ProfesionalPacienteController;
use App\Http\Controllers\Api\VentaIngresoController;
use App\Models\DocumentoConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicoPacienteController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});


Route::controller(AreaController::class)->group(function () {
    Route::get('/areas', 'index');
    Route::post('/area', 'store');
    Route::get('/area/{id}', 'show');
    Route::put('/area/{id}', 'update');
    Route::delete('/area/{id}', 'destroy');
});

Route::controller(AlmacenController::class)->group(function () {
    Route::get('/inventario', 'index');
    Route::post('/inventario', 'store');
    Route::get('/inventario/{id}', 'show');
    Route::put('/inventario/{id}', 'update');
    Route::put('/inventarioDescontar/{id}', 'descontar');
    Route::delete('/inventario/{id}', 'destroy');
});

Route::controller(AseguradoraController::class)->group(function () {
    Route::get('/aseguradora', 'index');
    Route::post('/aseguradora', 'store');
    Route::get('/aseguradora/{id}', 'show');
    Route::put('/aseguradora/{id}', 'update');
    Route::delete('/aseguradora/{id}', 'destroy');
});

Route::controller(BonosController::class)->group(function () {
    Route::get('/bonos', 'index');
    Route::post('/bono', 'store');
    Route::get('/bono/{id}', 'show');
    Route::put('/bono/{id}', 'update');
    Route::put('/descontarBono/{id}', 'descontar');
    Route::delete('/bono/{id}', 'destroy');
});

Route::controller(ConceptoController::class)->group(function () {
    Route::get('/conceptos', 'index');
    Route::post('/concepto', 'store');
    Route::get('/concepto/{id}', 'show');
    Route::put('/concepto/{id}', 'update');
    Route::delete('/concepto/{id}', 'destroy');
});

Route::controller(ConsultaController::class)->group(function () {
    Route::get('/consultas', 'index');
    Route::get('/consultas_por_dia/{fecha}', 'consultasPorDia');
    Route::post('/consulta', 'store');
    Route::post('/consulta_paciente', 'consultaPaciente');
    Route::get('/consulta/{id}', 'show');
    Route::put('/consulta/{id}', 'update');
    Route::put('/consulta/{id}/{eId}', 'updateEstado');
    Route::delete('/consulta/{id}', 'destroy');
});

Route::controller(ConsultorioController::class)->group(function () {
    Route::get('/consultorios', 'index');
    Route::get('/consultoriosArea/{id}', 'consultorioPorArea');
    Route::post('/consultorio', 'store');
    Route::get('/consultorio/{id}', 'show');
    Route::put('/consultorio/{id}', 'update');
    Route::delete('/consultorio/{id}', 'destroy');
});

Route::controller(DocumentoConsulta::class)->group(function () {
    Route::get('/archivos', 'index');
    Route::post('/archivo', 'store');
    Route::get('/archivo/{id}', 'show');
    Route::put('/archivo/{id}', 'update');
    Route::delete('/archivo/{id}', 'destroy');
});

Route::controller(FacturaController::class)->group(function () {
    Route::get('/facturas', 'index');
    Route::post('/factura', 'store');
    Route::get('/factura/{id}', 'show');
    Route::get('/ultimasFacturas/{id}', 'ultimasFacturas');
    Route::put('/factura/{id}', 'update');
    Route::delete('/factura/{id}', 'destroy');
});

Route::controller(GastoController::class)->group(function () {
    Route::get('/gastos', 'index');
    Route::post('/gasto', 'store');
    Route::get('/gasto/{id}', 'show');
    Route::put('/gasto/{id}', 'update');
    Route::delete('/gasto/{id}', 'destroy');
});

Route::controller(HistorialController::class)->group(function () {
    Route::get('/historias', 'index');
    Route::post('/historia', 'store');
    Route::get('/historia/{id}', 'show');
    Route::put('/historia/{id}', 'update');
    Route::delete('/historia/{id}', 'destroy');
});

Route::controller(MedicoController::class)->group(function () {
    Route::get('/medicos', 'index');
    Route::post('/medico', 'store');
    Route::get('/medico/{id}', 'show');
    Route::put('/medico/{id}', 'update');
    Route::delete('/medico/{id}', 'destroy');
});

Route::controller(PacienteController::class)->group(function () {
    Route::get('/pacientes', 'index');
    Route::post('/paciente', 'store');
    Route::get('/paciente/{id}', 'show');
    Route::put('/paciente/{id}', 'update');
    Route::delete('/paciente/{id}', 'destroy');
    Route::post('/paciente_profesional', 'agregarProfesional');
    Route::get('/paciente/profesionales/{id}', 'profesionales');
});

Route::controller(ProductoController::class)->group(function () {
    Route::get('/productos', 'index');
    Route::post('/producto', 'store');
    Route::get('/producto/{id}', 'show');
    Route::put('/producto/{id}', 'update');
    Route::delete('/producto/{id}', 'destroy');
});

Route::controller(ProductosUsoController::class)->group(function () {
    Route::get('/materiales', 'index');
    Route::post('/material_uso', 'store');
    Route::get('/material_uso/{id}', 'show');
    Route::put('/material_uso/{id}', 'update');
    Route::delete('/material_uso/{id}', 'destroy');
});

Route::controller(ProfesionalController::class)->group(function () {
    Route::get('/profesionales', 'index');
    Route::post('/profesional', 'store');
    Route::get('/profesional/{id}', 'show');
    Route::put('/profesional/{id}', 'update');
    Route::delete('/profesional/{id}', 'destroy');
});

Route::controller(ProfesionalPacienteController::class)->group(function () {
    Route::post('/profesionales_pacientes', 'store');
    Route::get('/profesionales_pacientes/{pacId}', 'getProfesionales');
    Route::get('/pacientes_profesionales/{profId}', 'getPacientes');
});

Route::controller(MedicoPacienteController::class)->group(function () {
    Route::post('/medico_paciente', 'store');
    Route::get('/medicos_pacientes/{pacId}', 'getMedicos');
    Route::get('/pacientes_medicos/{pacId}', 'getPacientes');
});

Route::controller(ProveedorController::class)->group(function () {
    Route::get('/proveedores', 'index');
    Route::post('/proveedor', 'store');
    Route::get('/proveedor/{id}', 'show');
    Route::put('/proveedor/{id}', 'update');
    Route::delete('/proveedor/{id}', 'destroy');
});

Route::controller(TipoConsultaController::class)->group(function () {
    Route::get('/tipoConsultas', 'index');
    Route::post('/tipoConsulta', 'store');
    Route::get('/tipoConsulta/{id}', 'show');
    Route::put('/tipoConsulta/{id}', 'update');
    Route::delete('/tipoConsulta/{id}', 'destroy');
});

Route::controller(VentaController::class)->group(function () {
    Route::get('/ventas', 'index');
    Route::post('/venta', 'store');
    Route::get('/venta/{id}', 'show');
    Route::put('/venta/{id}', 'update');
    Route::delete('/venta/{id}', 'destroy');
});

Route::controller(EstadoCitaController::class)->group(function () {
    Route::get('/estadoCitas', 'index');
    Route::post('/estadoCita', 'store');
    Route::get('/estadoCita/{id}', 'show');
    Route::put('/estadoCita/{id}', 'update');
    Route::delete('/estadoCita/{id}', 'destroy');
});

Route::controller(VentaIngresoController::class)->group(function () {
    Route::get('/detalleProductosVentas', 'index');
    Route::post('/detalleProductosVentas', 'store');
    Route::get('/detalleProductoVenta/{id}', 'show');
    Route::put('/detalleProductoVenta/{id}', 'update');
    Route::delete('/detalleProductoVenta/{id}', 'destroy');
});

Route::controller(ServiciosController::class)->group(function () {
    Route::get('/servicios', 'index');
    Route::post('/servicio', 'store');
    Route::get('/servicio/{id}', 'show');
    Route::put('/servicio/{id}', 'update');
    Route::delete('/servicio/{id}', 'destroy');
});

Route::controller(DiagnosticoController::class)->group(function () {
    Route::get('/diagnosticos', 'index');
    Route::post('/diagnostico', 'store');
    Route::get('/diagnostico/{id}', 'show');
    Route::put('/diagnostico/{id}', 'update');
    Route::delete('/diagnostico/{id}', 'destroy');
});

Route::controller(TratamientoController::class)->group(function () {
    Route::get('/tratamientos', 'index');
    Route::post('/tratamiento', 'store');
    Route::get('/tratamiento/{id}', 'show');
    Route::put('/tratamiento/{id}', 'update');
    Route::delete('/tratamiento/{id}', 'destroy');
});


Route::controller(IngresoProductoController::class)->group(function () {
    Route::get('/ingreso_productos', 'index');
});

Route::controller(IngresoProductoUsoController::class)->group(function () {
    Route::post('/ingreso_producto_uso', 'store');
    Route::put('/ingreso_producto_uso/{id}', 'update');
    Route::put('/consumir_ingreso_producto_uso/{id}', 'consumir');
    Route::get('/ingreso_producto_uso/{id}', 'show');
});

Route::controller(ImportarDatosController::class)->group(function () {
    Route::post('/importar', 'store');
});

Route::controller(EstadisticasController::class)->group(function () {
    Route::get('/asistencias_por_area/{areaId}/{desde}/{hasta}', 'estadisticaAsistenciasPorArea');
    Route::get('/asistencias/{citaId}/{consultorioId}/{desde}/{hasta}', 'estadisticaAsistencias');
    Route::get('/consultas/{pacienteId}/{citaId}/{desde}/{hasta}', 'estadisticaConsultas');
    Route::get('/estadisticas_ventas/{pacienteId}/{desde}/{hasta}', 'estadisticaVentas');
    Route::get('/estadisticas_consumo_stock/{productoId}', 'estadisticaConsumoStock');
});

Route::controller(FichaMedicaController::class)->group(function () {
    Route::get('/ficha_medica', 'index');
    Route::post('/ficha_medica', 'store');
    Route::post('/ficha_medica_imagen', 'imageStore');
});

Route::controller(DescuentoController::class)->group(function () {
    Route::get('/descuento', 'index');
    Route::post('/descuento', 'store');
});
