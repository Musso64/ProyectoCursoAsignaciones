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
        $validated = $request->validate([
            'ci' => 'required|unique:empleados,ci|numeric|min:10000000|max:33000000',
            'fname' => 'required|string|max:20',
            'sname' => 'nullable|string|max:20',
            'flastname' => 'required|string|max:20',
            'slastname' => 'nullable|string|max:20',
            'department' => 'required|string|in:' . implode(',', EnumHelper::getValues('empleados', 'department')),
            'email' => 'required|email|max:100|unique:empleados,email',
            'phonenumber' => 'required|string|max:15',
            'position' => 'required|string|in:' . implode(',', EnumHelper::getValues('empleados', 'position')),
            'birthdate' => 'required|date|before:2007-12-31',
        ], [
            'ci.required' => 'El campo CI es obligatorio.',
            'ci.unique' => 'El CI ya está registrado.',
            'ci.numeric' => 'El CI debe ser un número.',
            'ci.min' => 'El CI debe ser al menos 10000000.',
            'ci.max' => 'El CI no debe ser mayor a 33000000.',

            'fname.required' => 'El campo Primer Nombre es obligatorio.',
            'fname.string' => 'El campo Primer Nombre debe ser una cadena de texto.',
            'fname.max' => 'El campo Primer Nombre no debe exceder los 20 caracteres.',

            'sname.string' => 'El campo Segundo Nombre debe ser una cadena de texto.',
            'sname.max' => 'El campo Segundo Nombre no debe exceder los 20 caracteres.',

            'flastname.required' => 'El campo Primer Apellido es obligatorio.',
            'flastname.string' => 'El campo Primer Apellido debe ser una cadena de texto.',
            'flastname.max' => 'El campo Primer Apellido no debe exceder los 20 caracteres.',

            'slastname.string' => 'El campo Segundo Apellido debe ser una cadena de texto.',
            'slastname.max' => 'El campo Segundo Apellido no debe exceder los 20 caracteres.',

            'department.required' => 'El campo Departamento es obligatorio.',
            'department.string' => 'El campo Departamento debe ser una cadena de texto.',
            'department.in' => 'El campo Departamento seleccionado no es válido.',

            'email.required' => 'El campo Correo Electrónico es obligatorio.',
            'email.email' => 'El campo Correo Electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El campo Correo Electrónico no debe exceder los 100 caracteres.',
            'email.unique' => 'El Correo Electrónico ya está registrado.',

            'phonenumber.required' => 'El campo Número de Teléfono es obligatorio.',
            'phonenumber.string' => 'El campo Número de Teléfono debe ser una cadena de texto.',
            'phonenumber.max' => 'El campo Número de Teléfono no debe exceder los 15 caracteres.',

            'position.required' => 'El campo Puesto es obligatorio.',
            'position.string' => 'El campo Puesto debe ser una cadena de texto.',
            'position.in' => 'El campo Puesto seleccionado no es válido.',

            'birthdate.required' => 'El campo Fecha de Nacimiento es obligatorio.',
            'birthdate.date' => 'El campo Fecha de Nacimiento debe ser una fecha válida.',
            'birthdate.before' => 'El empleado debe ser mayor de 17 años.',
        ]);
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|max:2048|mimes:png,jpg,jpeg' // Max 2MB
            ], [
                'photo.image' => 'El archivo debe ser una imagen.',
                'photo.max' => 'La imagen no debe ser mayor a 2MB.',
                'photo.mimes' => 'Los formatos permitidos son: PNG, JPG, JPEG.'
            ]);
            $filename = $request['ci'] . '.' . $request->file('photo')->extension();
            $path = $request->file('photo')->storeAs('images', $filename, 'public');
            $validated['photo'] = $path;
        } else{
            $validated['photo'] = 'default-avatar.png';
        }
        $validated['hiredate'] = date('Y-m-d');
        Empleado::create($validated);
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
        if ($employee->photo and $employee->photo != 'default-avatar.png') {
            Storage::disk('public')->delete($employee->photo);
        }
        
         $fullPath = $request->file('photo')->store('images', 'public');
        $path = basename($fullPath);
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
