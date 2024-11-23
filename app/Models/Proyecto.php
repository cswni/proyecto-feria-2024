<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre',
        'sede',
        'categoria',
        'area',
        'requerimientos',
        'miembros',
        'telefonos',
        'tutores',
        'nota',
    ];
}
