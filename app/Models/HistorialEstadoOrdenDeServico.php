<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEstadoOrdenDeServico extends Model
{
    use HasFactory;

    protected $table = "historial_estado_orden_de_servicio";
    protected $primaryKey = "id";
    public $incrementing = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $with = ['empleado'];

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'dni', 'dni_empleado');
    }
}
