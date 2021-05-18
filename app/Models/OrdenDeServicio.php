<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDeServicio extends Model
{
    use HasFactory;

    protected $table = 'orden_de_servicio';
    protected $primaryKey = 'nro';
}
