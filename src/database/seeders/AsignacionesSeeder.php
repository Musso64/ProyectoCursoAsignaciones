<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Empleado;
use App\Models\Detalles_Asignacions;
use App\Models\Asignaciones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresas= Empresa::all();
        $empleados= Empleado::all();
        $detallesAsignacions= Detalles_Asignacions::all();
        foreach ($empleados as $empleado) {
            $empresa = $empresas->random();
            $detallesAsignacion = $detallesAsignacions->random();
                Asignaciones::create([
                    'empresa_id' => $empresa->id,
                    'empleado_ci' => $empleado->ci,
                    'detalles_asignacions_id' => $detallesAsignacion->id,
                ]);
        }
    }
}
