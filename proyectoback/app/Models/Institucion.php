<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $table = 'instituciones';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'tipo',
        'turno',
        'vacante',
        'informacion',
        'foto',
        'mensualidad',
        'tipo_ins',
        // Agrega aquí otros campos si es necesario
    ];
}
