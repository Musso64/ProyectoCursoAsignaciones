<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Empresa::query();
        if ($request->has('search') and $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%");
        });
        }
        $companies = $query->paginate(10);
        return view('companies.index', [
            'empresas' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:empresas,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:200'
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 50 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.max' => 'El correo electrónico no debe exceder los 100 caracteres.',

            'phone.required' => 'El número telefónico es obligatorio.',
            'phone.string' => 'El número telefónico debe ser una cadena de texto.',
            'phone.max' => 'El número telefónico no debe exceder los 15 caracteres',

            'address.required' => 'La dirección es obligatoria.',
            'address.string' => 'La dirección debe ser una cadena de texto.',
            'address.max' => 'La dirección no debe exceder los 200 caracteres.'
        ]);
        Empresa::create($validated);
        return redirect()->route('companies.index')->with('success', 'Compañia agregada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(empresa $empresa)
    {
    $empresa->load('asignaciones.empleados', 'asignaciones.detalles_asignacions');
    return view('companies.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(empresa $empresa)
    {
        return view('companies.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empresa $empresa)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:50',
        'email' => 'required|email|max:100|unique:empresas,email,' . $empresa->id,
        'phone' => 'required|string|max:15',
        'address' => 'required|string|max:200'
    ], [
        'name.required' => 'El nombre es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de texto.',
        'name.max' => 'El nombre no debe exceder los 50 caracteres.',

        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser una dirección válida.',
        'email.unique' => 'El correo electrónico ya está en uso.',
        'email.max' => 'El correo electrónico no debe exceder los 100 caracteres.',

        'phone.required' => 'El número telefónico es obligatorio.',
        'phone.string' => 'El número telefónico debe ser una cadena de texto.',
        'phone.max' => 'El número telefónico no debe exceder los 15 caracteres',

        'address.required' => 'La dirección es obligatoria.',
        'address.string' => 'La dirección debe ser una cadena de texto.',
        'address.max' => 'La dirección no debe exceder los 200 caracteres.'
    ]);    
    $empresa->update($validated);
    return redirect()->route('companies.show', $empresa->id)->with('success', 'Empresa actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(empresa $empresa)
    {
    $empresa->delete();
    return redirect()->route('companies.index')->with('success', 'Empresa eliminada correctamente');
    }
}
