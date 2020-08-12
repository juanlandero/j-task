<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_status', function (Blueprint $table) {
            $table->increments('pk_tarea_status');
            $table->string('tarea_status');
            $table->string('descripcion', 50);
            $table->string('class');
            $table->timestamps();
        });

        DB::statement("INSERT INTO  tareas_status
            (
                pk_tarea_status, tarea_status, descripcion, class
            )
            VALUES
                ( 1, 'Pendiente', 'Nueva tarea designada por el Docente', 'badge badge-pill badge-default z-depth-0'), 
                ( 2, 'Entregada', 'Se han recibido los archivos del alumno', 'badge badge-pill badge-primary z-depth-0'),
                ( 3, 'Revisada', 'El docente a asignado una calificacion', 'badge badge-pill badge-success z-depth-0'),
                ( 4, 'Corregir', 'Errores en la tarea, debe entregarse de nuevo', 'badge badge-pill badge-warning z-depth-0'),
                ( 5, 'No entregada', 'El alumno no entrego la tarea a tiempo', 'badge badge-pill badge-danger z-depth-0')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas_status');
    }
}
