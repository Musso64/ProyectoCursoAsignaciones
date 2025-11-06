<?php

namespace App\Http\Controllers;

use App\Helpers\EnumHelper;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employees.index', [
            'empleados' => Empleado::all()
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
        $fullname= $request->input('name');
        $nameParts= explode(' ', $fullname);
        $date= date('Y-m-d');
        Empleado::create([
            'ci' => $request->input('ci'),
            'fname' => $nameParts[0],
            'sname'=> isset($nameParts[2]) ? $nameParts[2] : '',
            'flastname' => isset($nameParts[1]) ? $nameParts[1] : '',
            'slastname' => isset($nameParts[3]) ? $nameParts[3] : '',
            'department' => $request->input('department'),
            'email'=> $request->input('email'),
            'phonenumber' => $request->input('phonenumber'),
            'position' => $request->input('position'),
            'hiredate' => $date,
            'birthdate' => $request->input('birthdate')
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return view('employees.show', compact('empleado'));

    }
    /**
     * Show the form for editing the specified resource.
     */

    public function edit(empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(empleado $empleado)
    {
        //
    }
}
