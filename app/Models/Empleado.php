<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class Empleado extends Usuario
{
    use HasFactory;
    use Notifiable;

    protected $table= "empleado";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guard = "empleados";

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
}
