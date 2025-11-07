<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('empleado_ci')->nullable(false);
            $table->unsignedBigInteger('empresa_id')->nullable(false);
            $table->unsignedBigInteger('detalles_asignacions_id')->nullable(false);
            $table->foreign('empleado_ci')->references('ci')->on('empleados')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('detalles_asignacions_id')->references('id')->on('detalles_asignacions')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
