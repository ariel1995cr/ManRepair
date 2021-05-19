<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\OrdenDeServicioController;
use App\Http\Controllers\dashboard\MarcaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::resource('dashboard/marcas', MarcaController::class);
Route::get('iniciarSesion', [EmpleadoController::class, 'index'])->name('empleado.iniciarSesion')->middleware('auth.redirect');

Route::post('iniciarSesion', [EmpleadoController::class, 'ingresar'])->name('empleado.iniciarSesion.post');

Route::group(['middleware' => 'auth:empleados','prefix' => 'admin'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});


