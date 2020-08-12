<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_tareas', function (Blueprint $table) {
            $table->increments('pk_alumno_tarea');

            $table->unsignedInteger('alumno_pk_usuario');
            $table->foreign('alumno_pk_usuario')->references('pk_usuario')->on('users');

            $table->unsignedInteger('pk_tarea');
            $table->foreign('pk_tarea')->references('pk_tarea')->on('tareas');

            $table->text('respuesta');
            $table->integer('calificacion')->nullable();
            $table->text('observacion');

            $table->unsignedInteger('pk_tarea_status');
            $table->foreign('pk_tarea_status')->references('pk_tarea_status')->on('tareas_status');

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
        Schema::dropIfExists('alumnos_tareas');
    }
}
