<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Grupo;

class TeacherDashboardController extends Controller
{
    public function index(){
        return view('teacher_dashboard.index');
    }

    public function groups(){
        $objGrupo = DB::table('grupos')
                        ->join('grupos_niveles', 'grupos.pk_grupo_nivel', '=', 'grupos_niveles.pk_grupo_nivel')
                        ->get();

        return view('teacher_dashboard.grupo', ['grupos' => $objGrupo]);
    }

    public function subjects(){
        $grupos = DB::table('grupos')
                        ->join('grupos_niveles', 'grupos.pk_grupo_nivel', '=', 'grupos_niveles.pk_grupo_nivel')
                        ->where('bloqueado', 0)->get();


        return view('teacher_dashboard.materia', ['grupos' => $grupos]);
    }

    public function task(){
        $pk_usuario = Auth::user()->pk_usuario;
        $objMaterias = DB::table('materias')->where('docente_pk_usuario', $pk_usuario)->get();

        return view('teacher_dashboard.tarea', ['materias' => $objMaterias]);
    }

}
