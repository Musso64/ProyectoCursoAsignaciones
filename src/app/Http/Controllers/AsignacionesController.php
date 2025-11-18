<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Detalles_Asignacions;
use App\Models\Empleado;
use App\Models\Empresa;
use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asignaciones::query()->with(['empleados','empresas','detalles_asignacions']);
        if ($request->has('search') and $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
            $q->whereHas('empleados', function($subQuery) use ($search) {
                $subQuery->where('fname', 'LIKE', "%{$search}%")
                ->orWhere('sname', 'LIKE', "%{$search}%")
                ->orWhere('flastname', 'LIKE', "%{$search}%")
                ->orWhere('slastname', 'LIKE', "%{$search}%")
                ->orWhere('ci', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phonenumber', 'LIKE', "%{$search}%");
            });
            $q->whereHas('empresas', function($subQuery) use ($search) {
                $subQuery->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%");
            });
            $q->whereHas('detalles_asignacions', function($subQuery) use ($search) {
                $subQuery->where('assignation_name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhere('due_date', 'LIKE', "%{$search}%")
                ->orWhere('assigned_date', 'LIKE', "%{$search}%");
            });
        });
        }
        if ($request->has('department') and $request->department != '') {
            $query->where('department', $request->department);
        }
        if ($request->has('position') and $request->position != '') {
            $query->where('position', $request->position);
        }
        if ($request->has('status') and $request->status != '') {
            $query->whereHas('detalles_asignacions', function($q) use ($request) {
                $q->where('status', $request->status);
            });
        }
        $asignaciones = $query->paginate(10);
        return view('assignments.index',[
            'asignaciones'=>$asignaciones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleado::all();
        $empresas = Empresa::all();
        return view('assignments.create',[
            'empleados'=>$empleados,
            'empresas'=>$empresas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(asignaciones $asignacion)
    {
        $asignacion->load('empresas','empleados','detalles_asignacions');
        return view('assignments.show',[
            'asignacion'=>$asignacion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asignaciones $asignaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, asignaciones $asignaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asignaciones $asignaciones)
    {
        //
    }
}
