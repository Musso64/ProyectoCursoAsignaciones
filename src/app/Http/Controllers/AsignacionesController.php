<?php

namespace App\Http\Controllers;

use App\Models\Asignaciones;
use App\Models\Detalles_Asignacions;
use App\Models\Empleado;
use App\Models\Empresa;
use Illuminate\Auth\Events\Validated;
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
        $validated= $request->validate([
            'assignation_name'=>'required|string|min:10|max:100',
            'description'=>'required|string|min:10|max:65535',
            'assigned_date'=>'required|date',
            'due_date'=>'required|date|after_or_equal:assigned_date',
            'ci'=>'required|exists:empleados,ci',
            'empresa_id'=>'required|exists:empresas,id'
        ],[
            'ci.exists'=>'El empleado seleccionado no existe.',
            'empresa_id.exists'=>'La empresa seleccionada no existe.',

            'assignation_name.required'=>'El nombre de la asignación es obligatorio.',
            'assignation_name.string'=>'El nombre de la asignación debe ser una cadena de texto',
            'assignation_name.min'=>'El nombre de la asignación debe tener al menos 10 caracteres.',
            'assignation_name.max'=>'El nombre de la asignación no debe exceder los 100 caracteres.',

            'description.required'=>'La descripción de la asignación es obligatoria.',
            'description.string'=>'La descripción de la asignación debe ser una cadena de texto',
            'description.min'=>'La descripción de la asignación debe tener al menos 10 caracteres.',
            'description.max'=>'La descripción de la asignación no debe exceder los 65535 caracteres.',

            'assigned_date.required'=>'La fecha de asignación es obligatoria.',
            'assigned_date.date'=>'La fecha de asignación no es una fecha válida.', 

            'due_date.required'=>'La fecha de vencimiento es obligatoria.',
            'due_date.date'=>'La fecha de vencimiento no es una fecha válida.',
            'due_date.after_or_equal'=>'La fecha de vencimiento debe ser igual o posterior a la fecha de asignación.',
        ]);
        $detalleAsignacion = Detalles_Asignacions::create([
            'assignation_name'=>$validated['assignation_name'],
            'description'=>$validated['description'],
            'assigned_date'=>$validated['assigned_date'],
            'due_date'=>$validated['due_date'],
            'status'=>'En progreso'
        ]);
        Asignaciones::create([
            'empleado_ci'=>$validated['ci'],
            'empresa_id'=>$validated['empresa_id'],
            'detalles_asignacions_id'=>$detalleAsignacion->id
        ]);
        return redirect()->route('assignments.index')->with('success','Asignación creada exitosamente.');
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
    public function edit(asignaciones $asignacion)
    {
        $empleados = Empleado::all();
        $empresas = Empresa::all();
        $asignacion->load('detalles_asignacions');
        $estados = ['Pendiente','En progreso','Completada','Cancelada'];
        return view('assignments.edit',[
            'asignacion'=>$asignacion,
            'empleados'=>$empleados,
            'empresas'=>$empresas,
            'estados'=>$estados
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, asignaciones $asignaciones)
    {
        $validated= $request->validate([
            'assignation_name'=>'required|string|min:10|max:100',
            'description'=>'required|string|min:10|max:65535',
            'due_date'=>'required|date|after_or_equal:assigned_date',
            'status'=>'required|in:Pendiente,En progreso,Completada,Cancelada',
            'ci'=>'required|exists:empleados,ci',
            'empresa_id'=>'required|exists:empresas,id'
        ],[
            'ci.exists'=>'El empleado seleccionado no existe.',
            'empresa_id.exists'=>'La empresa seleccionada no existe.',

            'assignation_name.required'=>'El nombre de la asignación es obligatorio.',
            'assignation_name.string'=>'El nombre de la asignación debe ser una cadena de texto',
            'assignation_name.min'=>'El nombre de la asignación debe tener al menos 10 caracteres.',
            'assignation_name.max'=>'El nombre de la asignación no debe exceder los 100 caracteres.',

            'description.required'=>'La descripción de la asignación es obligatoria.',
            'description.string'=>'La descripción de la asignación debe ser una cadena de texto',
            'description.min'=>'La descripción de la asignación debe tener al menos 10 caracteres.',
            'description.max'=>'La descripción de la asignación no debe exceder los 65535 caracteres.',

            'due_date.required'=>'La fecha de vencimiento es obligatoria.',
            'due_date.date'=>'La fecha de vencimiento no es una fecha válida.',
            'due_date.after_or_equal'=>'La fecha de vencimiento debe ser igual o posterior a la fecha de asignación.',

            'status.required'=>'El estado es obligatorio.',
            'status.in'=>'El estado seleccionado no es válido.'
        ]);
        $asignaciones->detalles_asignacions->update([
            'assignation_name'=>$validated['assignation_name'],
            'description'=>$validated['description'],
            'due_date'=>$validated['due_date'],
            'status'=>$validated['status']
        ]);
        $asignaciones->update([
            'empleado_ci'=>$validated['ci'],
            'empresa_id'=>$validated['empresa_id']
        ]);
        return redirect()->route('assignments.index')->with('success','Asignación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asignaciones $asignaciones)
    {
        $asignaciones->delete();
        return redirect()->route('assignments.index')->with('success','Asignación eliminada exitosamente.');
    }
}
