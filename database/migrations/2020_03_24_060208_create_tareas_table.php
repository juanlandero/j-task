<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('pk_tarea');
            
            $table->unsignedInteger('pk_materia');
            $table->foreign('pk_materia')->references('pk_materia')->on('materias');

            $table->string('tarea_titulo', 100);
            $table->text('tarea_detalle');

            $table->timestamp('fecha_entrega');

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
        Schema::dropIfExists('tareas');
    }
}
