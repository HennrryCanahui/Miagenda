<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $fillable = [
        'numero',
        'tipo',
        'contacto_id',
        'created_at',
        'updated_at',
    ];
}
