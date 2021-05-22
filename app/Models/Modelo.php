<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Modelo extends Model
{
    use HasFactory;
    protected $primaryKey = 'nombre';
    protected $table = "modelo";
    public $incrementing = false;
    public $timestamps = false;

}
