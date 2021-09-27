<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\OrdenDeServicioController;
// use App\Http\Controllers\dashboard\MarcaController as MarcaGonza;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AdminController;
use App\Models\Estado;
use App\Models\OrdenDeServicio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ReporteController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('pruebaSeeder', function (){
    OrdenDeServicio::factory()->count(10)->make()->each(function ($orden){
        $modelo = \App\Models\Modelo::inRandomOrder()->first();
        $celular = \App\Models\Celular::firstOrCreate(
            ['imei'=>$orden->imei],
            ['nombre_marca'=>$modelo->nombre_marca, 'nombre_modelo'=>$modelo->nombre]
        );

        $orden->save();

        $estados = new \App\Models\Estado();
        $historialEstado = new \App\Models\HistorialEstadoOrdenDeServico();
        $historialEstado->nro_orden_de_servicio = $orden->nro;
        $historialEstado->nombre_estado = 'Recibido';
        $historialEstado->dni_empleado = $orden->dni_empleado;
        $historialEstado->save();

        $int = random_int(0,6);
        for ($i = 0; $i <= $int; $i++) {
            if($orden->estado_actual != "Entregado"){
                $nuevoEstado = $estados->obtenerEstadoPosibles($orden->estado_actual)->first();
                $historialEstado = new \App\Models\HistorialEstadoOrdenDeServico();
                $historialEstado->nro_orden_de_servicio = $orden->nro;
                $historialEstado->nombre_estado = $nuevoEstado->nombre;
                $historialEstado->dni_empleado = $orden->dni_empleado;
                if($nuevoEstado->nombre == \App\Models\Estado::PRESUPUESTADO){
                    $orden->detalle_reparacion = "detalle de reparacion";
                    $orden->materiales_necesarios = "lista de materiales";
                    $orden->importe_reparacion = random_int(1000,15000);
                    $orden->save();
                }
                if($nuevoEstado->nombre == \App\Models\Estado::NOREPARADO){
                    $orden->importe_reparacion = 0;
                    $orden->save();
                    $historialEstado->comentario = "por x motivo no se pudo reparar";
                }
                $historialEstado->save();
            }
        }
    });
});

Route::get('pruebaSeederReingreso', function (){
    $ordenesDeServicio = OrdenDeServicio::whereHas('historico_estado', function ($q){
        $q->whereIn('nombre_estado', ['Entregado', 'Reparado']);
    })->whereHas('historico_estado', function ($q){
        $q->where('nombre_estado', 'Reparado');
    })->get();

    foreach ($ordenesDeServicio as $orden) {
        $empleado = \App\Models\Empleado::inRandomOrder()->first();
        $reingreso = $orden->replicate();
        $reingreso->nro_orden_anterior = $orden->nro;
        $reingreso->motivo_orden = 'Fallo el arreglo';
        $reingreso->importe_reparacion = 0;
        $reingreso->dni_empleado = $empleado->dni;
        $reingreso->save();
        $estado = new \App\Models\HistorialEstadoOrdenDeServico();
        $estado->nro_orden_de_servicio = $reingreso->nro;
        $estado->nombre_estado = Estado::RECIBIDO;
        $estado->dni_empleado = \App\Models\Empleado::inRandomOrder()->first()->dni;
        $estado->save();
        $estado = new \App\Models\HistorialEstadoOrdenDeServico();
        $estado->nro_orden_de_servicio = $reingreso->nro;
        $estado->nombre_estado = Estado::PRESUPUESTADO;
        $estado->dni_empleado = \App\Models\Empleado::inRandomOrder()->first()->dni;
        $estado->save();
        $estado = new \App\Models\HistorialEstadoOrdenDeServico();
        $estado->nro_orden_de_servicio = $reingreso->nro;
        $estado->nombre_estado = Estado::ENREPARACION;
        $estado->dni_empleado = \App\Models\Empleado::inRandomOrder()->first()->dni;
        $estado->save();
        $estados = new \App\Models\Estado();
        $int = random_int(0,6);
        for ($i = 0; $i <= $int; $i++) {
            if($reingreso->estado_actual != "Entregado"){
                $nuevoEstado = $estados->obtenerEstadoPosibles($reingreso->estado_actual)->first();
                $historialEstado = new \App\Models\HistorialEstadoOrdenDeServico();
                $historialEstado->nro_orden_de_servicio = $reingreso->nro;
                $historialEstado->nombre_estado = $nuevoEstado->nombre;
                $historialEstado->dni_empleado = $reingreso->dni_empleado;
                if($nuevoEstado->nombre == \App\Models\Estado::NOREPARADO){
                    $reingreso->importe_reparacion = 0;
                    $reingreso->save();
                    $historialEstado->comentario = "por x motivo no se pudo reparar";
                }
                $historialEstado->save();
            }
        }
    }


});

Route::resource('/', InicioController::class)->only(['index']);

Route::get('ordenDeServicio/{nroOrdenDeServicio?}', [OrdenDeServicioController::class, 'buscar'])->name('orden.buscar');

Route::get('iniciarSesion', [EmpleadoController::class, 'iniciarSesion'])->name('empleado.iniciarSesion')->middleware('auth.redirect');

Route::post('iniciarSesion', [EmpleadoController::class, 'ingresar'])->name('empleado.iniciarSesion.post');

Route::group(['middleware' => 'auth:empleados', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('cerrarSesion', [EmpleadoController::class, 'cerrarSesion'])->name('admin.cerrarSesion');

    Route::get('cambiarContraseña', [EmpleadoController::class, 'editarContrasena'])->name('admin.empleado.cambiarContraseña');
    Route::post('cambiarContraseña', [EmpleadoController::class, 'saveContrasena'])->name('admin.empleado.cambiarContraseñaPost');

    Route::resource('ordenDeServicio', OrdenDeServicioController::class)->only(['create', 'store']);
    Route::group(['prefix' => 'ordenDeServicio'], function () {
        Route::get('ver/{nroOrdenDeServicio}', [OrdenDeServicioController::class, 'verOrdenDeServicio'])->name('admin.ordenDeServicio.ver');
        Route::get('reingreso', [OrdenDeServicioController::class, 'createReingreso'])->name('admin.ordenDeServicio.reingreso.view');
        Route::post('reingreso', [OrdenDeServicioController::class, 'altaReingreso'])->name('admin.ordenDeServicio.altaReingreso');
        Route::get('listar', [OrdenDeServicioController::class, 'listar'])->name('admin.ordenDeServicio.listar');
        Route::get('/{nroOrdenDeServicio}/cambiarEstado', [OrdenDeServicioController::class, 'cambiarEstadoView'])->name('admin.ordenDeServicio.cambiarEstado');
        Route::post('/{nroOrdenDeServicio}/cambiarEstado', [OrdenDeServicioController::class, 'cambiarEstado'])->name('admin.ordenDeServicio.cambiarEstado.Post');
        Route::get('reingresoValido/{nroOrdenDeServicio}', [OrdenDeServicioController::class, 'validarOrdenyGarantia']);
    });


    Route::get('marcas/obtenerModelos/{marca}', [MarcaController::class, 'listarModelos']);
    Route::resource('marcas', MarcaController::class)->except('destroy');
    Route::group(['prefix' => 'marcas'], function () {
      Route::delete('/desactivar', [MarcaController::class, 'destroy'])->name('marcas.destroy');
        Route::post('/reactivar', [MarcaController::class, 'reactivar'])->name('marcas.reactivar');
    });

    Route::resource('modelos', ModeloController::class)->except('destroy');
    Route::group(['prefix' => 'modelos'], function () {
        Route::delete('/desactivar', [ModeloController::class, 'destroy'])->name('modelos.destroy');
        Route::post('/reactivar', [ModeloController::class, 'reactivar'])->name('modelos.reactivar');
    });
    Route::resource('empleados', EmpleadoController::class)->middleware('administrador');
    Route::resource('clientes', ClienteController::class);

    Route::group(['prefix' => 'clientes'], function () {
        Route::get('campo/{campo}/dni/{dni}', [ClienteController::class, 'buscarCliente']);
    });

    Route::group(['prefix' => 'reportes'], function () {
        Route::get('generar', [ReporteController::class, 'index'])->name('admin.reportes.generarView');
        Route::post('generar', [ReporteController::class, 'generarReporte'])->name('admin.reportes.generarReporteDeServicio');
    });
});
