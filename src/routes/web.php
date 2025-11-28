<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\AsignacionesController;
use App\Models\Asignaciones;
use App\Models\Empresa;
use Illuminate\Support\Facades\Route;
use App\Models\Empleado;

Route::bind('employee', function ($value) {
    return Empleado::where('ci', $value)->firstOrFail();
});

Route::bind('company', function ($value) {
    return Empresa::where('id', $value)->firstOrFail();
});

Route::bind('assignment', function ($value) {
    return Asignaciones::where('id', $value)->firstOrFail();
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

Route::resource('/employees', EmpleadoController::class)
->missing(function (Request $request) {
    return Redirect::route('employees.index');
});

Route::resource('/companies', EmpresaController::class)
->missing(function (Request $request) {
    return Redirect::route('companies.index');
});

Route::resource('/assignments', AsignacionesController::class)
->missing(function (Request $request) {
    return Redirect::route('assignments.index');
});
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
