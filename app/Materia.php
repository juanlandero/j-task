<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pk_materia';

    public function grupo(){
        return $this->hasOne('App\Grupo');
    }
}
