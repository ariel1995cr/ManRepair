<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "cliente";
    protected $primaryKey = "dni";
    public $incrementing = false;
    public $timestamps = false;

    // Gonza //
    protected $fillable = ['nombre', 'dni', 'apellido', 'numero_de_telefono', 'email'];

    public function scopeBuscarCliente($query, $campo, $valor){
        return $query->where($campo, $valor);
    }
}
