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
        Schema::create('empleados', function (Blueprint $table) {
            $table->integer('ci',8)->primary()->unique()->nullable(false);
            $table->string('fname',20)->nullable(false);
            $table->string('sname',20)->nullable();
            $table->string('flastname',20)->nullable(false);
            $table->string('slastname',20)->nullable();
            $table->string('email',100);
            $table->string('phonenumber',15);
            $table->date('birthdate')->nullable(false);
            $table->date('hiredate')->nullable(false);
            $table->enum('position',['Gerente','Asistente','Senior','Socio'])->default('Asistente')->nullable(false);
            $table->enum('department',['Administracion','Impuesto','IT','Marketing','Auditoria'])->default('Auditoria')->nullable(false    );
            $table->string('photo');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
