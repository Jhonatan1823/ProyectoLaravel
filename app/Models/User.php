<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'ID_Usuario';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Usuario', 'Correo', 'Contraseña', 'Codigo_Rol', 'Nombre'
    ];

    protected $hidden = [
        'Contraseña',
    ];

    public function getAuthPassword()
    {
        return $this->Contraseña;
    }

    public function setContraseñaAttribute($value)
    {
        $this->attributes['Contraseña'] = Hash::make($value);
    }
}
