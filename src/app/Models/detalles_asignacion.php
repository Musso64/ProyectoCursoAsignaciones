<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalles_Asignacion extends Model
{   
    use SoftDeletes;
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
