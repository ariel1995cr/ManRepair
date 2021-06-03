<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celular extends Model
{
    use HasFactory;

    protected $primaryKey = "imei";
    protected $table = "celular";
    public $incrementing = false;

    protected $fillable = ['imei', 'nombre_marca', 'nombre_modelo'];
}
