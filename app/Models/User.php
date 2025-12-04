<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nombre de la tabla personalizada
    protected $table = 'usuario';
    
    // Clave primaria personalizada
    protected $primaryKey = 'ID_Usuario';
    public $incrementing = false;
    protected $keyType = 'string';
    
    // DESACTIVAR TIMESTAMPS - ESTA ES LA LÍNEA IMPORTANTE
    public $timestamps = false;
    
    // Campos que se pueden asignar masivamente
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
    
    // Campos ocultos en arrays/JSON
    protected $hidden = [
        'Contraseña',
        'remember_token',
    ];
    
    /**
     * Método para obtener la contraseña para autenticación
     */
    public function getAuthPassword()
    {
        return $this->Contraseña;
    }
    
    /**
     * Mutador CORREGIDO para hashear la contraseña automáticamente al guardar
     */
    public function setContraseñaAttribute($value)
    {
        if (!empty($value)) {
            // Verificar si ya está hasheada (comienza con $2y$ para bcrypt)
            $isAlreadyHashed = preg_match('/^\$2y\$/', $value);
            
            if (!$isAlreadyHashed) {
                // Si no está hasheada, hashéala
                $this->attributes['Contraseña'] = Hash::make($value);
            } else {
                // Si ya está hasheada, guardarla tal cual
                $this->attributes['Contraseña'] = $value;
            }
        }
    }
    
    /**
     * Verificar si la contraseña está hasheada
     */
    public function isPasswordHashed()
    {
        return preg_match('/^\$2y\$/', $this->Contraseña);
    }
    
    /**
     * Método para verificar si una contraseña dada es válida
     */
    public function checkPassword($plainPassword)
    {
        // Si la contraseña en BD está hasheada, usar Hash::check
        if ($this->isPasswordHashed()) {
            return Hash::check($plainPassword, $this->Contraseña);
        }
        
        // Si está en texto plano, comparar directamente
        return $plainPassword === $this->Contraseña;
    }
    
    /**
     * Verificar si el usuario es técnico
     */
    public function isTecnico()
    {
        return $this->Codigo_Rol == 1;
    }
    
    /**
     * Verificar si el usuario es cliente
     */
    public function isCliente()
    {
        return $this->Codigo_Rol == 2;
    }
    
    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin()
    {
        return $this->Codigo_Rol == 3;
    }
}
