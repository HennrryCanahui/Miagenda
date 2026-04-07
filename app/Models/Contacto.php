<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'usuario_id',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'pais',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
