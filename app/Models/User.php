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
        'ID_Usuario',
        'Codigo_Documento',
        'Nombre',
        'Fecha_Nacimiento',
        'Direccion',
        'Telefono',
        'Correo',
        'Contraseña',
        'Codigo_Rol'
    ];

   
    protected $hidden = [
        'Contraseña',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->Contraseña;
    }
    public function setContraseñaAttribute($value)
    {
        $this->attributes['Contraseña'] = Hash::make($value);
    }

    protected function casts(): array
    {
        return [
            'Fecha_Nacimiento' => 'date',
            'email_verified_at' => 'datetime',
           
        ];
    }


    public function rol()
    {
        return $this->belongsTo(Roles::class, 'Codigo_Rol', 'Codigo_Rol');
    }

   
    public function getNombreRol()
    {
        $roles = [
            1 => 'Técnico',
            2 => 'Cliente',
            3 => 'Administrador'
        ];
        
        return $roles[$this->Codigo_Rol] ?? 'Desconocido';
    }
}
