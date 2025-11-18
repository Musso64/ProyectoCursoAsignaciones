<?php

namespace Database\Seeders;

use Database\Factories\Detalles_AsignacionsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Detalles_Asignacions;

class DetallesAsignacionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Detalles_Asignacions::factory()->count(15)->create();
    }
}
