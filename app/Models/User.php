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
     * Mutador para hashear la contraseña automáticamente al guardar
     */
    public function setContraseñaAttribute($value)
    {
        // Solo hashear si no está ya hasheado
        if (!empty($value) && !Hash::needsRehash($value) && strlen($value) < 60) {
            $this->attributes['Contraseña'] = Hash::make($value);
        } else {
            $this->attributes['Contraseña'] = $value;
        }
    }
    
    /**
     * Relación con la tabla de roles (si existe)
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'Codigo_Rol', 'Codigo_Rol');
    }
}
