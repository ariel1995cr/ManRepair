<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $primaryKey = "nombre";
    protected $table = "estado";
    public $incrementing = false;
    public $timestamps = false;

    const RECIBIDO = 'Recibido';
    const PRESUPUESTADO = 'Presupuestado';
    const NOREPARADO = 'No reparado';
    const ENREPARACION = 'En reparacion';
    const REPARADO = 'Reparado';
    const LISTOPARAENTREGA = 'Listo para entrega';
    const ENTREGADO = 'Entregado';


    public function obtenerEstadoPosibles($estadoActual){
        if($estadoActual == self::RECIBIDO){
            $query =  $this->where('nombre',self::PRESUPUESTADO);
        }
        if($estadoActual == self::PRESUPUESTADO){
            $query =  $this->whereIn('nombre', [self::ENREPARACION, self::NOREPARADO]);
        }
        if($estadoActual == self::ENREPARACION){
            $query = $this->whereIn('nombre', [self::NOREPARADO, self::REPARADO]);
        }
        if($estadoActual == self::NOREPARADO){
            $query = $this->whereIn('nombre', [self::LISTOPARAENTREGA]);
        }
        if($estadoActual == self::REPARADO){
            $query = $this->whereIn('nombre', [self::LISTOPARAENTREGA]);
        }
        if($estadoActual == self::LISTOPARAENTREGA){
            $query = $this->whereIn('nombre', [self::ENTREGADO]);
        }

        return $query->get();
    }
}
