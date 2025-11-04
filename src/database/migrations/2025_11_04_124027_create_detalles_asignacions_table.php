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
        Schema::create('detalles_asignacions', function (Blueprint $table) {
            $table->id()->primary()->unique();
            $table->string('assignation_name',100)->nullable(false);
            $table->text('description');
            $table->date('assigned_date')->nullable(false);
            $table->date('due_date')->nullable(false);
            $table->enum('status',['Pendiente','En progreso','Completada','Cancelada'])->default('Pendiente')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_asignacions');
    }
};
