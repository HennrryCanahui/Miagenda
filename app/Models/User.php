<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'rol_id',
        'nombres',
        'apellidos',
        'email',
        'password',
        'pregunta_secreta',
        'respuesta_secreta',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class,'rol_id');
    }

    public function contactos()
    {
        return $this->hasMany(Contacto::class,'usuario_id');
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class,'usuario_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Determine if the user has the Administrator role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->rol && $this->rol->nombre === 'Administrador';
    }

    /**
     * Determine if the user has the Standard User role.
     *
     * @return bool
     */
    public function isStandard(): bool
    {
        return $this->rol && $this->rol->nombre === 'Usuario estándar';
    }
}
