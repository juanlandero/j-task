<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AlumnoGrupo;

class GrupoController extends Controller
{
    public function getStudents(Request $r){
        $pk_grupo = $r['pk_grupo'];

        $lista = AlumnoGrupo::select(
                                'alumnos_grupos.pk_alumno_grupo',
                                'users.pk_usuario',
                                'alumnos_grupos.pk_grupo',
                                'users.name',
                                'users.first_name',
                                'users.second_name',
                                'users.email'
                            )
                            ->join('users', 'alumnos_grupos.alumno_pk_usuario', '=', 'users.pk_usuario')
                            ->where('alumnos_grupos.pk_grupo', $pk_grupo)
                            ->orderBy('users.first_name')
                            ->get();

        if (sizeof($lista) > 0) {
            return $lista;
        } else {
            return false;
        }
    }
}
