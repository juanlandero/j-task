<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoGrupo extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pk_alumno_grupo';

    protected $table = 'alumnos_grupos';



    public function grupo(){
        return $this->hasOne('App\Grupo');
    }
}
