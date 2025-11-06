<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Detalles_Asignacion;
use App\Models\Empleado;
use App\Models\Empresa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $empleados= Empleado::with('asignaciones')->get();
        $empresas= Empresa::with('asignaciones')->get();
        $asignaciones= Asignaciones::with(['empleados','empresas','detalles_asignacions'])->get();
        $detalles_asignacions= Detalles_Asignacion::with('asignaciones')->get();

        return view('dashboard',[
            'empleados'=> $empleados,
            'empresas'=> $empresas,
            'asignaciones'=> $asignaciones,
            'detalles_asignacions'=> $detalles_asignacions
        ]);
    }
}