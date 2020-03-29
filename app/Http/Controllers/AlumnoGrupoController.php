<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\AlumnoGrupo;


class AlumnoGrupoController extends Controller
{
    public function index(){
        $arrNiveles = array();
        $objNiveles = DB::table('grupos_niveles')->where('activo', 1)->get();

        foreach ($objNiveles as $nivel) {
            $arrGrupos = array();
            $objGrupo = DB::table('grupos')->where('pk_grupo_nivel', $nivel->pk_grupo_nivel)->get();

            foreach ($objGrupo as $grupo) {
                array_push($arrGrupos, array(
                    'pk_grupo'  => $grupo->pk_grupo,
                    'grupo'     => $grupo->grupo,
                    'bloqueado' => $grupo->bloqueado
                ));
            }

            array_push($arrNiveles, array(
                'pk_grupo_nivel' => $nivel->pk_grupo_nivel,
                'nivel'          => $nivel->grupo_nivel,
                'grupos'         => $arrGrupos,
            ));
        }
        return view('nivel', ['niveles' => $arrNiveles]);
    }

    public function setGrade(Request $r){

        if (Auth::check()) {
            $usuario = DB::table('alumnos_grupos')->where('pk_usuario', Auth::user()->pk_usuario)->count();
            if ($usuario == 0) {
                $nuevoAg = new AlumnoGrupo;

                $nuevoAg->pk_usuario    = Auth::user()->pk_usuario;
                $nuevoAg->pk_grupo      = $r['nivel'];
                $nuevoAg->save();

                if ($nuevoAg) {
                    return redirect()->route('student.index');
                } else { 
                    return ['texto' => 'no se pudoo registrar'];
                }
                
            } else {
                return redirect()->route('index');
            }

        } else {
            return redirect()->route('index');
        }
    }
}
