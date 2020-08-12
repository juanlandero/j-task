<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTareasRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_tareas_recursos', function (Blueprint $table) {
            $table->increments('pk_alumno_tarea_recurso');
            $table->string('recurso');
            $table->string('url');

            $table->unsignedInteger('pk_alumno_tarea');
            $table->foreign('pk_alumno_tarea')->references('pk_alumno_tarea')->on('alumnos_tareas');
            
            $table->unsignedInteger('pk_tipo_recurso');
            $table->foreign('pk_tipo_recurso')->references('pk_tipo_recurso')->on('tipos_recursos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos_tareas_recursos');
    }
}
