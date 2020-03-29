<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Materia;
use App\Grupo;
use App\User;


class MateriaController extends Controller
{
    
    public function getSubjects(){
        $pk_usuario = Auth::user()->pk_usuario;

        if (Auth::user()->pk_usuario != 3) {
            $arrMaterias = array();
            $objMaterias = DB::table('materias')
                                ->join('grupos', 'materias.pk_grupo', '=', 'grupos.pk_grupo')
                                ->join('grupos_niveles', 'grupos.pk_grupo_nivel', '=', 'grupos_niveles.pk_grupo_nivel')
                                ->select(
                                    'materias.pk_materia',
                                    'materias.materia',
                                    'materias.pk_usuario',
                                    'materias.pk_grupo',
                                    'grupos.grupo',
                                    'grupos_niveles.grupo_nivel',
                                    'materias.created_at'
                                )
                                ->where('materias.pk_usuario', $pk_usuario)
                                ->where('materias.activo', 1)
                                ->get();
            
            foreach ($objMaterias as $materia) {
                
                array_push($arrMaterias, array(
                    "pk_materia"    => $materia->pk_materia,
                    "materia"       => $materia->materia,
                    "pk_usuario"    => $materia->pk_usuario,
                    "docente"       => Auth::user()->name,
                    "pk_grupo"      => $materia->pk_grupo,
                    "grupo"         => $materia->grupo,
                    "grado"         => $materia->grupo_nivel,
                    "creado"        => $materia->created_at,
                ));
            }

            return ['materia' => $arrMaterias];
        } else {
            return ['ol' => 'No estas autirzado'];
        }
    }

    public function newSubjects(Request $r){
        $materia = $r['materia'];
        $pk_grupo = $r['pk_grupo'];

        $nuevaMateria = new Materia;
        $nuevaMateria->materia = $materia;
        $nuevaMateria->pk_usuario = Auth::user()->pk_usuario;
        $nuevaMateria->pk_grupo = $pk_grupo;
        $nuevaMateria->color = '#ff3547';
        $nuevaMateria->activo = 1;
        $nuevaMateria->save();

        return true;
    }
}
