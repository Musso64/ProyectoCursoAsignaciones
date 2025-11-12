<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;
    use HasFactory;
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
