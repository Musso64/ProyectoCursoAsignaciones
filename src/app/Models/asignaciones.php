<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asignaciones extends Model
{
    public $timestamps = false;
    protected $table = "asignaciones";
    public function empleados ():BelongsTo
    {
        return $this->belongsTo(Empleado::class,'empleado_ci','ci');
    }
    public function empresas(): BelongsTo
    {
        return $this->belongsTo(Empresa::class,'empresa_id','id');
    }
    public function detalles_asignacions(): BelongsTo
    {
        return $this->belongsTo(Detalles_Asignacion::class,'detalles_asignacions_id','id');
    }

}
