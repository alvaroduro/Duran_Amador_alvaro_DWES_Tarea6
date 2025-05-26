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

    // Si tu tabla no tiene columnas created_at ni updated_at
    public $timestamps = false;

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

