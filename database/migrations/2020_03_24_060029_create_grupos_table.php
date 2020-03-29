<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('pk_grupo');
            $table->string('grupo');

            $table->unsignedInteger('pk_grupo_nivel');
            $table->foreign('pk_grupo_nivel')->references('pk_grupo_nivel')->on('grupos_niveles');

            $table->boolean('bloqueado')->default(false);
            $table->timestamps();
        });

        DB::statement("INSERT INTO  grupos
            (
                pk_grupo, grupo, pk_grupo_nivel, bloqueado
            )
            VALUES
                ( 1, 'Primero', 2, 0), 
                ( 2, 'Segundo', 2, 0),
                ( 3, 'Tercero', 2, 0),
                ( 4, 'Primero', 1, 0),
                ( 5, 'Segundo', 1, 0),
                ( 6, 'Tercero', 1, 0),
                ( 7, 'Cuarto', 1, 0),
                ( 8, 'Quinto', 1, 0),
                ( 9, 'Sexto', 1, 0)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
