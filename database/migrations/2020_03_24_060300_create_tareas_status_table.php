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
            $table->timestamps();
        });

        DB::statement("INSERT INTO  tareas_status
            (
                pk_tarea_status, tarea_status, descripcion
            )
            VALUES
                ( 1, 'Pendiente', 'Nueva tarea designada por el Docente'), 
                ( 2, 'Entregada', 'Se han recibido los archivos del alumno'),
                ( 3, 'Revisada', 'El docente a asignado una calificacion'),
                ( 4, 'Corregir', 'Errores en la tarea, debe entregarse de nuevo'),
                ( 5, 'No entregada', 'El alumno no entrego la tarea a tiempo')
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
