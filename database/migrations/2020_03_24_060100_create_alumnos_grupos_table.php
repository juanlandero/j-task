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

            $table->unsignedInteger('alumno_pk_usuario');
            $table->foreign('alumno_pk_usuario')->references('pk_usuario')->on('users');

            $table->unsignedInteger('pk_grupo');
            $table->foreign('pk_grupo')->references('pk_grupo')->on('grupos');

            $table->timestamps();
        });

        DB::statement("INSERT INTO  alumnos_grupos
            (
                pk_alumno_grupo, alumno_pk_usuario, pk_grupo, created_at 
            )
            VALUES
                (1, 3, 1, NOW()),
                (2, 4, 2, NOW())
        ");
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
