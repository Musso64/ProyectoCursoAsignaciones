<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\UserController;
use App\Models\Asignaciones;
use App\Models\Empresa;
use App\Models\User;
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

Route::resource('/employees', EmpleadoController::class)
->missing(function (Request $request) {
    return Redirect::route('employees.index');
})->middleware('auth');

Route::resource('/companies', EmpresaController::class)
->missing(function (Request $request) {
    return Redirect::route('companies.index');
})->middleware('auth');

Route::resource('/assignments', AsignacionesController::class)
->missing(function (Request $request) {
    return Redirect::route('assignments.index');
})->middleware('auth');
Auth::routes();

Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')  // This automatically handles redirection for non-auth users
    ->name('home');

// Keep your dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::resource('/user', UserController::class)->middleware('auth');