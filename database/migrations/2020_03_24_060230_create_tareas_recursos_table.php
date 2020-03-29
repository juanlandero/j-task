<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_recursos', function (Blueprint $table) {
            $table->increments('pk_recurso');
            $table->string('recurso');
            $table->text('detalle');

            $table->unsignedInteger('pk_tipo_recurso');
            $table->foreign('pk_tipo_recurso')->references('pk_tipo_recurso')->on('tipos_recursos');

            $table->unsignedInteger('pk_tarea');
            $table->foreign('pk_tarea')->references('pk_tarea')->on('tareas');

            $table->boolean('activo')->default(true);
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
        Schema::dropIfExists('tareas_recursos');
    }
}
