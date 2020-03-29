<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoTareaRecurso extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pk_alumno_tarea_recurso';

    protected $table = 'alumnos_tareas_recursos';
}
