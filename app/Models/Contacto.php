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
        'categoria_id',
        'direccion',
        'notas',
        'foto_path'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoria_id');
    }

    public function telefonos()
    {
        return $this->hasMany(Telefono::class,'contacto_id');
    }
}
