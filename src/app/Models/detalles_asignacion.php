<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalles_Asignacion extends Model
{
    public $timestamps = false;
    protected $table = "detalles_asignacions";
    public function asignaciones()
    {
        return $this->hasMany(Asignaciones::class,'detalles_asignacions_id','id');
    }
}
