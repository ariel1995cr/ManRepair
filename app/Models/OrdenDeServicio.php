<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdenDeServicio extends Model
{
    use HasFactory;

    protected $table = 'orden_de_servicio';
    protected $primaryKey = 'nro';
    public $incrementing = true;
    protected $with = ['historico_estado', 'celular', 'empleado', 'cliente', 'ordenSiguiente'];

    protected $dates = [
        'created_at',
        'updated_at',
        'tiempo_de_reparacion'
    ];

    public function crearOrdenDeServicio($motivo_orden, $descripcion_estado_celular, $imei, $dni_cliente){
        $this->motivo_orden = $motivo_orden;
        $this->descripcion_estado_celular = $descripcion_estado_celular;
        $this->imei = $imei;
        $this->dni_cliente = $dni_cliente;
        $this->dni_empleado = Auth::user()->dni;
        $this->save();
    }

    public function crearReingresoOrdenDeServicio($nro_orden_anterior,$motivo_orden, $descripcion_estado_celular, $imei, $dni_cliente, $detalle_reparacion, $materiales_necesarios){
        $this->nro_orden_anterior = $nro_orden_anterior;
        $this->motivo_orden = $motivo_orden;
        $this->detalle_reparacion = $detalle_reparacion;
        $this->materiales_necesarios = $materiales_necesarios;
        $this->importe_reparacion = 0;
        $this->tiempo_de_reparacion = Carbon::now()->addDay(7)->toDate();
        $this->descripcion_estado_celular = $descripcion_estado_celular;
        $this->imei = $imei;
        $this->dni_cliente = $dni_cliente;
        $this->dni_empleado = Auth::user()->dni;
        $this->save();
    }

    public function historico_estado(){
        return $this->belongsToMany(Estado::class, 'historial_estado_orden_de_servicio', 'nro_orden_de_servicio', 'nombre_estado')->withPivot('comentario', 'dni_empleado')->withTimestamps()->orderBy('created_at','asc');
    }


    public function ordenSiguiente(){
        return $this->hasOne(OrdenDeServicio::class, 'nro_orden_anterior', 'nro');
    }


    public function scopeExiste($query, $nro){
        return $query->where('nro', $nro);
    }

    public function scopeBuscar($query, $campo, $valor_de_busqueda){
        if($campo == 'nro'){
            return $query->where($campo, 'like', $valor_de_busqueda.'%');
        }


        if(in_array($campo, ['imei', 'nombre_marca', 'nombre_modelo'])){
            return $query->whereHas('celular', function ($query) use ($campo,$valor_de_busqueda){
                $query->latest()->where($campo,'like', $valor_de_busqueda.'%');
            });
        }
        if($campo == 'nombre'){
            return $query->whereHas('cliente', function ($query) use ($campo,$valor_de_busqueda){
                $query->where(DB::raw('concat(apellido," ",nombre)'),'like', $valor_de_busqueda.'%')->orWhere(DB::raw('concat(nombre," ",apellido)'),'like', $valor_de_busqueda.'%')->orWhere('dni','like', $valor_de_busqueda.'%');
            });
        }

        if ($campo == 'created_at'){
            return $query->whereHas('historico_estado', function ($query) use ($valor_de_busqueda){
                $fecha = Carbon::createFromFormat('d/m/Y', $valor_de_busqueda);
                $query->latest()->whereDate('created_at', $fecha);
            });
        }
    }

    public function scopeSinReingreso($query){
        return $query->whereNull('nro_orden_anterior');
    }

    public function scopeCoberturaValida($query, $nro){
        $orden = $query->where('nro', $nro)->first();

        if ($orden->reingresos->count() > 0){
            return ['valido'=>false, 'mensaje'=>'La orden ya fue reparada por garantía.'];
        }

        if($orden->estado_actual != Estado::ENTREGADO){
            return ['valido'=>false, 'mensaje'=>'La orden todavia no fue entregada.'];
        }
        $startDate = Carbon::now()->subDays(90);
        $endDate = Carbon::now();
        if(!$orden->historico_estado()->get()->last()->pivot->created_at->between($startDate, $endDate)){
            return ['valido'=>false, 'mensaje'=>'Expiro el tiempo de garantía.'];
        }

        return ['valido'=>true];
    }

    public function reingresos()
    {
        return $this->hasMany(OrdenDeServicio::class, 'nro_orden_anterior', 'nro');
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
        return $this->historico_estado()->latest()->get()->last()->nombre;
    }

    public function getUltimaActualizacionAttribute(){
        return $this->historico_estado()->latest()->get()->last()->pivot->created_at;
    }

    public function scopeFiltroServicios($query, $desde, $hasta,$estado){
        $desde = Carbon::createFromFormat('Y-m-d', $desde)->hour(00)->minute(00)->second(00);
        $hasta = Carbon::createFromFormat('Y-m-d', $hasta)->hour(23)->minute(59)->second(59);
        return $query->whereBetween('created_at', [$desde, $hasta]);
    }

    public function scopeCantidadReparadosPorMarca($query, $desde, $hasta, $marca){
        $desde = Carbon::createFromFormat('Y-m-d', $desde)->hour(00)->minute(00)->second(00);
        $hasta = Carbon::createFromFormat('Y-m-d', $hasta)->hour(23)->minute(59)->second(59);
        $query = $query->whereBetween('created_at', [$desde, $hasta]);
        if($marca != ''){
            $query->whereHas('celular', function ($query) use ($marca){
                if($marca != 'todos'){
                    $query->where('nombre_marca','=', $marca);
                }
            });
        }
        return $query;
    }
    public function scopeReparadosPorGarantia($query, $desde, $hasta, $marca){
        $desde = Carbon::createFromFormat('Y-m-d', $desde)->hour(00)->minute(00)->second(00);
        $hasta = Carbon::createFromFormat('Y-m-d', $hasta)->hour(23)->minute(59)->second(59);
        $query = $query->whereBetween('created_at', [$desde, $hasta])->whereNotNull('nro_orden_anterior');
        if($marca != ''){
            $query->whereHas('celular', function ($query) use ($marca){
                if($marca != 'todos'){
                    $query->where('nombre_marca','=', $marca);
                }
            });
        }
        return $query;
    }
}
