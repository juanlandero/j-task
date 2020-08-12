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

        if (Auth::user()->pk_usuario_tipo == 2) {
            
            $objTareas = Tarea::where('materias.docente_pk_usuario', $pk_usuario)
                            ->join('materias', 'tareas.pk_materia', '=', 'materias.pk_materia')
                            ->join('users', 'materias.docente_pk_usuario', '=', 'users.pk_usuario')
                            ->join('grupos', 'materias.pk_grupo', '=', 'grupos.pk_grupo')
                            ->select(
                                'tareas.pk_tarea',
                                'materias.pk_materia',
                                'materias.materia',
                                'materias.color',
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

            $grupos = AlumnoGrupo::select('pk_grupo')->where('alumno_pk_usuario', $pk_usuario)->get();

            foreach ($grupos as $grupo) {
                $objTareasDocente = Tarea::where('materias.pk_grupo', $grupo->pk_grupo)
                                ->where('materias.activo', 1)
                                ->join('materias', 'tareas.pk_materia', '=', 'materias.pk_materia')
                                ->join('grupos', 'materias.pk_grupo', '=', 'grupos.pk_grupo')
                                ->get();

                foreach ($objTareasDocente as $tarea) {
                    $pk_alumno_tarea = null;
                    $tarea_status = 'PENDIENTE';
                    $color_status = 'cyan-text';
                    $calificacion = "-";
                    $observacion = 'Ninguna';

                    $objTareaAlumno = AlumnoTarea::where('alumnos_tareas.alumno_pk_usuario', $pk_usuario)
                                        ->where('alumnos_tareas.pk_tarea', $tarea->pk_tarea)
                                        ->join('tareas_status', 'alumnos_tareas.pk_tarea_status', '=', 'tareas_status.pk_tarea_status')
                                        ->select(
                                            'alumnos_tareas.pk_alumno_tarea',
                                            'tareas_status.tarea_status',
                                            'tareas_status.class',
                                            'alumnos_tareas.calificacion',
                                            'alumnos_tareas.observacion'
                                        )
                                        ->first();

                    if ($objTareaAlumno != null) {
                        $pk_alumno_tarea = $objTareaAlumno->pk_alumno_tarea;
                        $tarea_status = $objTareaAlumno->tarea_status;
                        $color_status = $objTareaAlumno->class;
                        $calificacion = $objTareaAlumno->calificacion;
                        $observacion  = $objTareaAlumno->observacion;
                    } 

                    array_push($arrTareas, array(
                        'pk_tarea'          => $tarea->pk_tarea,
                        'tarea'             => $tarea->tarea_titulo,
                        'detalle'           => $tarea->tarea_detalle,
                        'fecha_entrega'     => $tarea->fecha_entrega,
                        'fecha_creacion'    => $tarea->created_at,

                        'pk_materia'        => $tarea->pk_materia,
                        'materia'           => $tarea->materia,
                        'color'             => $tarea->color,

                        'pk_grupo'          => $tarea->pk_grupo,
                        'grupo'             => $tarea->grupo,

                        'pk_alumno_tarea'   => $pk_alumno_tarea,
                        'status'            => $tarea_status,
                        'color_status'      => $color_status,
                        'calificacion'      => $calificacion,
                        'observacion'       => $observacion,
                    ));
                    
                }
            }

            return $arrTareas;
        }
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

    public function viewTask($pk_materia, $pk_tarea){

        $pk_usuario = Auth::user()->pk_usuario;

        if (Auth::user()->pk_usuario_tipo != 3) {
            
            $objTareas = Tarea::where('materias.docente_pk_usuario', $pk_usuario)
                            ->join('materias', 'tareas.pk_materia', '=', 'materias.pk_materia')
                            ->join('users', 'materias.docente_pk_usuario', '=', 'users.pk_usuario')
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
            $arrTarea = array();


            return AlumnoGrupo::join('grupos', 'alumnos_grupos.pk_grupo', 'grupos.pk_grupo')
                            ->join('materias', 'grupos.pk_grupo', 'materias.pk_grupo')
                            ->get();



            $materia = Materia::where('pk_materia', $pk_materia)
                                ->select(
                                    'pk_materia',
                                    'materia',
                                    'color',
                                    'pk_grupo',
                                )
                                ->first();
            $grupoMateria = AlumnoGrupo::where('pk_grupo', $materia->pk_grupo)->count();
            
            if ($grupoMateria > 0) {

                $objTareaDetalle = Tarea::where('tareas.pk_tarea', $pk_tarea)
                                        ->where('tareas.pk_materia', $pk_materia)
                                        ->where('materias.activo', 1)
                                        ->select(
                                            'tareas.pk_tarea',
                                            'tareas.tarea_titulo',
                                            'tareas.tarea_detalle',
                                            'tareas.fecha_entrega',
                                            'tareas.created_at',
                                        )
                                        ->join('materias', 'tareas.pk_materia', '=', 'materias.pk_materia')
                                        ->first();

                if ($objTareaDetalle != null) {

                    array_push($arrTarea, array(
                        'tarea'          => $objTareaDetalle,

                        'materia'        => $materia,

                        'recursos'       => TareaController::getStudentResources(1),
                    ));
                        
                    return ['tarea' => $arrTarea];
                    // return view('student_dashboard.view-task', ['var' => $pk_tarea]);
                }
                
            }

        
            return abort(404);
        }

    }

    public function submitTask($pk_tarea){

        return view('student_dashboard.submit', [
                                                 'pk_tarea' => $pk_tarea,
                                                 'pk_usuario' => Auth::user()->pk_usuario
                                            ]);
    }


    public function getStudentResources($pk_alumno_tarea){
        
        $objRecursoAlumno = AlumnoTareaRecurso::where('pk_alumno_tarea', $pk_alumno_tarea)->get();

        return $objRecursoAlumno;
    }
}