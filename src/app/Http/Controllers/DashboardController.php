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
        $empleados= Empleado::all();
        $empresas= Empresa::all();
        $asignaciones= Asignaciones::all();
        $detalles_asignacions= Detalles_Asignacion::all();

        return view('dashboard',[
            'empleados'=> $empleados,
            'empresas'=> $empresas,
            'asignaciones'=> $asignaciones,
            'detalles_asignacions'=> $detalles_asignacions
        ]);
    }
}