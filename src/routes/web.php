<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\DetallesAsignacionController;
use App\Models\Empresa;
use Illuminate\Support\Facades\Route;
use App\Models\Empleado;

Route::bind('employee', function ($value) {
    return Empleado::where('ci', $value)->firstOrFail();
});

Route::bind('company', function ($value) {
    return Empresa::where('id', $value)->firstOrFail();
});

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::resource('/employees', EmpleadoController::class)
->missing(function (Request $request) {
    return Redirect::route('employees.index');
});

Route::resource('/companies', EmpresaController::class)
->missing(function (Request $request) {
    return Redirect::route('companies.index');
});

Route::resource('/assignments', DetallesAsignacionController::class)
->missing(function (Request $request) {
    return Redirect::route('assignments.index');
});