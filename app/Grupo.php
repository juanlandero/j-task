<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pk_grupo';
    
    
    public function alumnoGrupo() {
        return $this->belongsTo('App\AlumnoGrupo');
    }

    public function materia() {
        return $this->belongsTo('App\Materia');
    }
}
