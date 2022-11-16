<?php

use App\Http\Controllers\EstatuController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SalaController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Creación de las rutas necesarias para realizar nuestro crud de estatus
//Ruta que muestra el listado de registros
Route::get('estatus', [EstatuController::class, 'index'])->name('estatus.index');
//Ruta de redireccionamiento a la vista para crear un nuevo registro
Route::get('estatus/create', [EstatuController::class, 'create'])->name('estatus.create');
//Ruta para crear un nuevo registro
Route::post('estatus', [EstatuController::class, 'store'])->name('estatus.store');
//Ruta que muestra los detalles de cada registro
Route::get('estatus/{estatu}', [EstatuController::class, 'show'])->name('estatus.show');
//Ruta de redireccionamiento a la vista para actualizar un registro
Route::get('estatus/{estatu}/edit', [EstatuController::class, 'edit'])->name('estatus.edit');
//Ruta para actualizar un regustro
Route::put('estatus/{estatu}', [EstatuController::class, 'update'])->name('estatus.update');
//Ruta para eliminar un registro
Route::delete('estatus/{estatu}/delete', [EstatuController::class, 'destroy'])->name('estatus.destroy');

//Creación de las rutas necesarias para realizar nuestro crud de salas
//Ruta que muestra el listado de registros
Route::get('salas', [SalaController::class, 'index'])->name('salas.index');
//Ruta de redireccionamiento a la vista para crear un nuevo registro
Route::get('salas/create', [SalaController::class, 'create'])->name('salas.create');
//Ruta para crear un nuevo registro
Route::post('salas', [SalaController::class, 'store'])->name('salas.store');
//Ruta que muestra los detalles de cada registro
Route::get('salas/{sala}', [SalaController::class, 'show'])->name('salas.show');
//Ruta de redireccionamiento a la vista para actualizar un registro
Route::get('salas/{sala}/edit', [SalaController::class, 'edit'])->name('salas.edit');
//Ruta para actualizar un regustro
Route::put('salas/{sala}', [SalaController::class, 'update'])->name('salas.update');
//Ruta para eliminar un registro
Route::delete('salas/{sala}/delete', [SalaController::class, 'destroy'])->name('salas.destroy');

//Creación de las rutas necesarias para realizar nuestro crud de reservas
//Ruta que muestra el listado de registros
Route::get('reservas', [ReservaController::class, 'index'])->name('reservas.index');
//Ruta de redireccionamiento a la vista para crear un nuevo registro
Route::get('reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
//Ruta para crear un nuevo registro
Route::post('reservas', [ReservaController::class, 'store'])->name('reservas.store');
//Ruta que muestra los detalles de cada registro
Route::get('reservas/{reserva}', [ReservaController::class, 'show'])->name('reservas.show');
//Ruta de redireccionamiento a la vista para actualizar un registro
Route::get('reservas/{reserva}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
//Ruta para actualizar un regustro
Route::put('reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
//Ruta para eliminar un registro
Route::delete('reservas/{reserva}/delete', [ReservaController::class, 'destroy'])->name('reservas.destroy');