<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AlumnoTarea;
use App\AlumnoTareaRecurso;

class AlumnoTareaController extends Controller
{
    public function saveTaskResource(Request $r){
        dd($r['fecha']);
        return $r;
        $pk_usuario = $r->input('pk_usuario');
        $pk_tarea = $r->input('pk_tarea');
        $archivo = $r->file('archivo');

        if ($archivo != null) {
            
            $urlArchivo = $archivo->store('alumnos');

            if ($urlArchivo != null) {
                $objAlumno = AlumnoTarea::where('alumno_pk_usuario', $pk_usuario)
                                        ->where('pk_tarea', $pk_tarea)
                                        ->first();

                if ($objAlumno != null) {

                    $nuevoRecurso = new AlumnoTareaRecurso;
                    $nuevoRecurso->recurso = $archivo->getClientOriginalName();
                    $nuevoRecurso->url = $urlArchivo;
                    $nuevoRecurso->pk_alumno_tarea = $objAlumno->pk_alumno_tarea;
                    $nuevoRecurso->pk_tipo_recurso = 1;

                    $nuevoRecurso->save();
                } else { 
                    $nuevoAlumnoTarea = new AlumnoTarea;
                    $nuevoAlumnoTarea->alumno_pk_usuario = $pk_usuario;
                    $nuevoAlumnoTarea->pk_tarea = $pk_tarea;
                    $nuevoAlumnoTarea->respuesta = '';
                    $nuevoAlumnoTarea->calificacion = null;
                    $nuevoAlumnoTarea->observacion = '';
                    $nuevoAlumnoTarea->pk_tarea_status = 2;

                    $nuevoAlumnoTarea->save();

                    $nuevoRecurso = new AlumnoTareaRecurso;
                    $nuevoRecurso->recurso = $archivo->getClientOriginalName();
                    $nuevoRecurso->url = $urlArchivo;
                    $nuevoRecurso->pk_alumno_tarea = $nuevoAlumnoTarea->pk_alumno_tarea;
                    $nuevoRecurso->pk_tipo_recurso = 1;

                    $nuevoRecurso->save();

                    if ($nuevoAlumnoTarea == true && $nuevoRecurso == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }

        return $urlArchivo;
    }

    public function getStudentResources(Request $r, $pk_alumno_tarea = null){
        
        $objRecursoAlumno = AlumnoTareaRecurso::where('pk_alumno_tarea', $r['pk_alumno_tarea'])->get();

        if (sizeof($objRecursoAlumno) == 0){
            $objRecursoAlumno = array(['recurso' => 'No se han enviado archivos']);
        }

        return $objRecursoAlumno;
    }
}
