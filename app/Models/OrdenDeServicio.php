<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrdenDeServicio extends Model
{
    use HasFactory;

    protected $table = 'orden_de_servicio';
    protected $primaryKey = 'nro';
    public $incrementing = true;
    protected $with = ['historico_estado', 'celular', 'empleado', 'cliente'];

    public function crearOrdenDeServicio($motivo_orden, $descripcion_estado_celular, $imei, $dni_cliente){
        $this->motivo_orden = $motivo_orden;
        $this->descripcion_estado_celular = $descripcion_estado_celular;
        $this->imei = $imei;
        $this->dni_cliente = $dni_cliente;
        $this->dni_empleado = Auth::user()->dni;
        $this->save();
    }

    public function historico_estado(){
        return $this->belongsToMany(Estado::class, 'historial_estado_orden_de_servicio', 'nro_orden_de_servicio', 'nombre_estado')->withTimestamps()->orderBy('created_at','asc');
    }

    public function celular(){
        return $this->belongsTo(Celular::class, 'imei', 'imei');
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'dni_empleado', 'dni');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'dni_cliente', 'dni');
    }

    public function getEstadoActualAttribute(){
        return $this->historico_estado()->latest()->get()->first()->nombre;
    }

    public function getUltimaActualizacionAttribute(){
        return $this->historico_estado()->latest()->get()->first()->pivot->created_at;
    }
}
