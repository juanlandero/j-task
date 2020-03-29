<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AlumnoTarea;
use App\AlumnoTareaRecurso;

class AlumnoTareaController extends Controller
{
    public function saveTaskResource(Request $r){
        $pk_usuario = $r->input('pk_usuario');
        $pk_tarea = $r->input('pk_tarea');
        $archivo = $r->file('archivo');

        //dd($archivo->originalName);
        if ($archivo != null) {
            
            $urlArchivo = $archivo->store('alumnos');

            if ($urlArchivo != null) {
                $objAlumno = AlumnoTarea::where('pk_usuario', $pk_usuario)
                                        ->where('pk_tarea', $pk_tarea)
                                        ->first();


                if ($objAlumno != null) {

                    $nuevoRecurso = new AlumnoTareaRecurso;
                    $nuevoRecurso->recurso = $urlArchivo;
                    $nuevoRecurso->pk_alumno_tarea = $objAlumno->pk_alumno_tarea;
                    $nuevoRecurso->pk_tipo_recurso = 1;

                    $nuevoRecurso->save();
                } else { 
                    $nuevoAlumnoTarea = new AlumnoTarea;
                    $nuevoAlumnoTarea->pk_usuario = $pk_usuario;
                    $nuevoAlumnoTarea->pk_tarea = $pk_tarea;
                    $nuevoAlumnoTarea->respuesta = '';
                    $nuevoAlumnoTarea->calificacion = 0;
                    $nuevoAlumnoTarea->observacion = '';
                    $nuevoAlumnoTarea->pk_tarea_status = 2;

                    $nuevoAlumnoTarea->save();

                    $nuevoRecurso = new AlumnoTareaRecurso;
                    $nuevoRecurso->recurso = $urlArchivo;
                    $nuevoRecurso->pk_alumno_tarea = $nuevoAlumnoTarea->pk_alumno_tarea;
                    $nuevoRecurso->pk_tipo_recurso = 1;

                    $nuevoRecurso->save();
                }
            }
        }

        return $urlArchivo;
    }
}
