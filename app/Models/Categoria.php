<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'usuario_id',
        'nombre',
        'color',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}

