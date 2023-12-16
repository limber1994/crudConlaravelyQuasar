<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'edad',
        'correo',
        // Agrega aquí otros campos si es necesario
    ];
}
