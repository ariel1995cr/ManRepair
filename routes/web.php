<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\OrdenDeServicioController;
// use App\Http\Controllers\dashboard\MarcaController as MarcaGonza;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ModeloController;


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

Route::resource('/', InicioController::class)->only(['index']);

Route::get('ordenDeServicio/{nroOrdenDeServicio?}', [OrdenDeServicioController::class, 'buscar'])->name('orden.buscar');

Route::get('iniciarSesion', [EmpleadoController::class, 'iniciarSesion'])->name('empleado.iniciarSesion')->middleware('auth.redirect');

Route::post('iniciarSesion', [EmpleadoController::class, 'ingresar'])->name('empleado.iniciarSesion.post');

Route::group(['middleware' => 'auth:empleados', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('cerrarSesion', [EmpleadoController::class, 'cerrarSesion'])->name('admin.cerrarSesion');

    Route::resource('ordenDeServicio', OrdenDeServicioController::class)->only(['create', 'store']);
    Route::group(['prefix' => 'ordenDeServicio'], function () {
        Route::get('reingreso', [OrdenDeServicioController::class, 'createReingreso'])->name('admin.ordenDeServicio.reingreso.view');
        Route::post('reingreso', [OrdenDeServicioController::class, 'altaReingreso'])->name('admin.ordenDeServicio.altaReingreso');
        Route::get('listar', [OrdenDeServicioController::class, 'listar'])->name('admin.ordenDeServicio.listar');
        Route::get('/{nroOrdenDeServicio}/cambiarEstado', [OrdenDeServicioController::class, 'cambiarEstadoView'])->name('admin.ordenDeServicio.cambiarEstado');
        Route::post('/{nroOrdenDeServicio}/cambiarEstado', [OrdenDeServicioController::class, 'cambiarEstado'])->name('admin.ordenDeServicio.cambiarEstado.Post');
        Route::get('reingresoValido/{nroOrdenDeServicio}', [OrdenDeServicioController::class, 'validarOrdenyGarantia']);
    });


    Route::get('marcas/obtenerModelos/{marca}', [MarcaController::class, 'listarModelos']);
    Route::resource('marcas', MarcaController::class);
    Route::resource('modelos', ModeloController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('clientes', ClienteController::class);

    Route::group(['prefix' => 'clientes'], function () {
        Route::get('campo/{campo}/dni/{dni}', [ClienteController::class, 'buscarCliente']);
    });
});
