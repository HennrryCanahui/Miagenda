<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = [
        'id',
        'nombre_rol',
        'descripcion',
        'created_at',
        'updated_at',
    ];
}
