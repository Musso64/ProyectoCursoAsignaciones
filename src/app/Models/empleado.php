<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;
    protected $table = "empleados";
    protected $primaryKey = "ci";
    public $incrementing = false;
    public $timestamps = false;

        public function getRouteKeyName()
    {
        return 'ci';
    }
    public function asignaciones()
    {
        return $this->hasMany(Asignaciones::class,'empleado_ci','ci');
    }
        protected $fillable = [
            'ci',
            'fname',
            'sname',
            'flastname',
            'slastname',
            'department',
            'position',
            'email',
            'phonenumber',
            'hiredate',
            'birthdate'
        ];
}
