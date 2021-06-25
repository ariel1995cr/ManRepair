<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'nombre';
    protected $table = "modelo";
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['fecha_lanzamiento'];

    protected $fillable = ['nombre', 'nombre_marca', 'fecha_lanzamiento', 'foto'];
}
