<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposNivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_niveles', function (Blueprint $table) {
            $table->increments('pk_grupo_nivel');
            $table->string('grupo_nivel', 20);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::statement("INSERT INTO  grupos_niveles
            (
                pk_grupo_nivel, grupo_nivel, activo
            )
            VALUES
                ( 1, 'Primaria', 1), 
                ( 2, 'Secundiaria', 1)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos_niveles');
    }
}
