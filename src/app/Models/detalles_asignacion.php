<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalles_Asignacion extends Model
{
    public $timestamps = false;
    protected $table = "detalles_asignacions";
    protected $fillable = [
        'assignation_name',
        'description',
        'assigned_date',
        'due_date',
        'status'
    ];
    public function asignaciones()
    {
        return $this->hasMany(Asignaciones::class,'detalles_asignacions_id','id');
    }
}
