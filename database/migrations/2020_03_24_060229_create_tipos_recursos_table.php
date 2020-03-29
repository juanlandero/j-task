<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_recursos', function (Blueprint $table) {
            $table->increments('pk_tipo_recurso');
            $table->string('tipo_recurso');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::statement("INSERT INTO  tipos_recursos
            (
                pk_tipo_recurso, tipo_recurso, activo
            )
            VALUES
                ( 1, 'link', 1), 
                ( 2, 'Imagen', 1),
                ( 3, 'Video', 1),
                ( 4, 'Audio', 1),
                ( 5, 'Documento', 1)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_recursos');
    }
}
