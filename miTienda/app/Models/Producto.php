<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Si el nombre de la tabla es diferente del plural del modelo (por convención),
    // debemos especificarlo:
    protected $table = 'productos';

    // Si tu clave primaria no se llama "id"
    protected $primaryKey = 'codprod';
    public $incrementing = true;         // Es autoincremental
    public $timestamps = false;          // Si no usas created_at / updated_at

    // Campos que se pueden asignar masivamente (desde formularios o API)
    protected $fillable = [
        'nombre',
        'categoria',
        'pvp',
        'stock',
        'imagen',
        'observaciones'
    ];
}

