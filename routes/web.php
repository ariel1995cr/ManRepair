<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\OrdenDeServicioController;
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
