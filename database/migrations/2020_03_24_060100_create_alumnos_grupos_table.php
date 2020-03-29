<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_grupos', function (Blueprint $table) {
            $table->increments('pk_alumno_grupo');

            $table->unsignedInteger('pk_usuario');
            $table->foreign('pk_usuario')->references('pk_usuario')->on('users');

            $table->unsignedInteger('pk_grupo');
            $table->foreign('pk_grupo')->references('pk_grupo')->on('grupos');

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
        Schema::dropIfExists('alumnos_grupos');
    }
}
