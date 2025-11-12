<?php

namespace App\Http\Controllers;

use App\Helpers\EnumHelper;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EmpleadoController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Empleado::query();
        if ($request->has('search') and $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
            $q->where('fname', 'LIKE', "%{$search}%")
            ->orWhere('sname', 'LIKE', "%{$search}%")
            ->orWhere('flastname', 'LIKE', "%{$search}%")
            ->orWhere('slastname', 'LIKE', "%{$search}%")
            ->orWhere('ci', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phonenumber', 'LIKE', "%{$search}%");
        });
        }
        if ($request->has('department') and $request->department != '') {
            $query->where('department', $request->department);
        }
        if ($request->has('position') and $request->position != '') {
            $query->where('position', $request->position);
        }
        $employees = $query->paginate(10);
        return view('employees.index', [
            'empleados' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = EnumHelper::getValues('empleados', 'department');
        $positions = EnumHelper::getValues('empleados', 'position');
        return view('employees.create', [
            'departments' => $departments,
            'positions' => $positions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
        }
        $date= date('Y-m-d');
        Empleado::create([
            'ci' => $request->input('ci'),
            'fname' => $request->input('fname'),
            'sname'=> $request->input('sname'),
            'flastname' => $request->input('flastname'),
            'slastname' => $request->input('slastname'),
            'department' => $request->input('department'),
            'email'=> $request->input('email'),
            'phonenumber' => $request->input('phonenumber'),
            'position' => $request->input('position'),
            'hiredate' => $date,
            'birthdate' => $request->input('birthdate'),
            'photo' => isset($path) ? $path : 'default-avatar.png'
        ]);
        return redirect()->route('employees.index')->with('success', 'Empleado creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado) 
    {
    $empleado->load('asignaciones.empresas', 'asignaciones.detalles_asignacions');
    return view('employees.show', compact('empleado'));
    }
    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Empleado $empleado)
    {
        $departments = EnumHelper::getValues('empleados', 'department');
        $positions = EnumHelper::getValues('empleados', 'position');
        return view('employees.edit', compact('empleado', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $employee)
    {
    if ($request->hasFile('photo')) {
        // Delete old picture if exists
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }
        
        $path = $request->file('photo')->store('images', 'public');
    }
    $employee->update([
        'fname' => $request->input('fname'),
        'sname'=> $request->input('sname'),
        'flastname' => $request->input('flastname'),
        'slastname' => $request->input('slastname'),
        'department' => $request->input('department'),
        'email'=> $request->input('email'),
        'phonenumber' => $request->input('phonenumber'),
        'position' => $request->input('position'),
        'birthdate' => $request->input('birthdate'),
        'photo' => isset($path) ? $path : $employee->photo
    ]);
    return redirect()->route('employees.show', $employee->ci)->with('success', 'Empleado actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado correctamente');
    }
}
