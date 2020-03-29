<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_tipos', function (Blueprint $table) {
            $table->increments('pk_usuario_tipo');
            $table->string('usuario_tipo', 20);
            $table->string('descripcion');
            $table->timestamps();
        });

        DB::statement("INSERT INTO  usuarios_tipos
            (
                pk_usuario_tipo, usuario_tipo, descripcion
            )
            VALUES
                ( 1, 'Administrador', 'Administradores principales del sistema'), 
                ( 2, 'Docente', 'Profesores a cargo de las materias'),
                ( 3, 'Alumno', 'Profesores a cargo de las materias')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_tipos');
    }
}
