<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $timestamps = false;
    protected $table = "empresas";
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone'
    ];
    public function asignaciones()
    {
        return $this->hasMany(Asignaciones::class,'empresa_id','id');
    }
}
