<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $fillable = [
        'contacto_id',
        'tipo',
        'codigo_pais',
        'numero',
    ];

    public function contacto()
    {
        return $this->belongsTo(Contacto::class,'contacto_id');
    }
}
