<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class Empleado extends Usuario
{
    use HasFactory;
    use Notifiable;



    protected $table = "empleado";
    protected $primaryKey = 'dni';
    public $timestamps = false;
    protected $guard = "empleados";

    protected $fillable = ['nombre', 'dni', 'apellido', 'numero_de_telefono', 'rol','email', 'contrasena']; // GonzaWarjir

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getAuthIdentifier()
    {
        return $this->email;
    }

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function setContrasenaAttribute($value)
    {
        $this->attributes['contrasena'] = Hash::make($value);
    }

    public function getFullNameAttribute()
    {
       return "{$this->nombre} {$this->apellido}";
    }
}
