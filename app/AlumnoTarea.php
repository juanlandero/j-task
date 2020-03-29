<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoTarea extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pk_alumno_tarea';

    protected $table = 'alumnos_tareas';
}
