<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'nombre',
        'color',
        'icono',
        'es_predefinida',
        'descripcion',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'categoria_id');
    }
}

