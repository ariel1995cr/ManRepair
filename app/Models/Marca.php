<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marca';
    protected $primaryKey = 'nombre';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['nombre', 'logo'];

    public function listarMarcas(){
        return Marca::all();
    }

    public function modelos(){
        return $this->hasMany(Modelo::class, 'nombre_marca', 'nombre');
    }

}
