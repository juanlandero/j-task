<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\User;
use App\Tarea;
use App\TareaStatus;
use App\AlumnoGrupo;
use App\AlumnoTarea;
use App\Materia;
use App\AlumnoTareaRecurso;

class TareaController extends Controller
{
    public function getTask(){
        $pk_usuario = Auth::user()->pk_usuario;

        if (Auth::user()->pk_usuario_tipo != 3) {
            
            $objTareas = Tarea::where('materias.pk_usuario', $pk_usuario)
                            ->join('materias', 'tareas.pk_materia', '=', 'materias.pk_materia')
                            ->join('users', 'materias.pk_usuario', '=', 'users.pk_usuario')
                            ->join('grupos', 'materias.pk_grupo', '=', 'grupos.pk_grupo')
                            ->select(
                                'tareas.pk_tarea',
                                'materias.pk_materia',
                                'materias.materia',
                                'tareas.tarea_titulo',
                                'tareas.tarea_detalle',
                                'tareas.fecha_entrega',
                                'grupos.grupo',
                                'users.name'
                            )
                            ->get();

            return ['tareas' => $objTareas];
        } elseif (Auth::user()->pk_usuario_tipo == 3) {
            $arrTareas = array();
            $grupo = AlumnoGrupo::where('pk_usuario', $pk_usuario)->first();

            $objTareasDocente = Tarea::where('materias.pk_grupo', $grupo->pk_grupo)
                            ->where('materias.activo', 1)
                            ->join('materias', 'tareas.pk_materia', '=', 'materias.pk_materia')
                            ->join('grupos', 'materias.pk_grupo', '=', 'grupos.pk_grupo')
                            ->get();

            foreach ($objTareasDocente as $tarea) {
                $tarea_status = 'Pendiente';
                $calificacion = 0;
                $observacion = 'Ninguna';
                $recursos = null;

                $objTareaAlumno = AlumnoTarea::where('alumnos_tareas.pk_usuario', $pk_usuario)
                                    ->where('alumnos_tareas.pk_tarea', $tarea->pk_tarea)
                                    ->join('tareas_status', 'alumnos_tareas.pk_tarea_status', '=', 'tareas_status.pk_tarea_status')
                                    ->select(
                                        'alumnos_tareas.pk_alumno_tarea',
                                        'tareas_status.tarea_status',
                                        'alumnos_tareas.calificacion',
                                        'alumnos_tareas.observacion',
                                    )
                                    ->first();

                $verTarea   = '<a type="button" href="task/submit/'. $tarea->pk_tarea .'" class="btn btn-indigo btn-sm m-0">IR</a>';

                if ($objTareaAlumno != null) {
                    $tarea_status = $objTareaAlumno->tarea_status;
                    $calificacion = $objTareaAlumno->calificacion;
                    $observacion  = $objTareaAlumno->observacion;

                    // $recursos = AlumnoTareaRecurso::where('pk_alumno_tarea',  $objTareaAlumno->pk_alumno_tarea)->get();
                } 

                array_push($arrTareas, array(
                    'pk_tarea'          => $tarea->pk_tarea,
                    'tarea'             => $tarea->tarea_titulo,
                    'detalle'           => $tarea->tarea_detalle,
                    'fecha_entrega'     => $tarea->fecha_entrega,
                    'fecha_creacion'    => $tarea->created_at,

                    'pk_materia'        => $tarea->pk_materia,
                    'materia'           => $tarea->materia,

                    'pk_grupo'          => $tarea->pk_grupo,
                    'grupo'             => $tarea->grupo,

                    'status'            => $tarea_status,
                    'calificacion'      => $calificacion,
                    'accion_entregar'   => $verTarea,
                ));
                
            }

            return $arrTareas;
        }
        return true;

    }

    public function newTask(Request $r){
        $tipoUsuario = Auth::user()->pk_tipo_usuario;

        if ($tipoUsuario != 3) {
            
            $nuevaTarea = new Tarea;
            $nuevaTarea->pk_materia = $r['materia'];
            $nuevaTarea->tarea_titulo = $r['titulo'];
            $nuevaTarea->tarea_detalle = $r['detalle'];
            $nuevaTarea->fecha_entrega = $r['fecha'];
            $nuevaTarea->save();

            return true;

        } else {
            return ['texto' => 'No estas autorizado'];
        }
    }


    public function submitTask($pk_tarea){


        return view('student_dashboard.submit', [
                                                 'pk_tarea' => $pk_tarea,
                                                 'pk_usuario' => Auth::user()->pk_usuario
                                            ]);
    }
}