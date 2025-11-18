<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignaciones extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $timestamps = false;
    protected $table = "asignaciones";
    protected $fillable = [
        'empleado_ci',
        'empresa_id',
        'detalles_asignacions_id'
    ];
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
        return $this->belongsTo(Detalles_Asignacions::class,'detalles_asignacions_id','id');
    }

}
