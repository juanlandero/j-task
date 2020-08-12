<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('pk_usuario');
            $table->string('name', 20);
            $table->string('first_name', 15);
            $table->string('second_name', 15);

            $table->unsignedInteger('pk_usuario_tipo');
            $table->foreign('pk_usuario_tipo')->references('pk_usuario_tipo')->on('usuarios_tipos');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("INSERT INTO  users
            (
                pk_usuario, name, first_name, second_name, pk_usuario_tipo, email, email_verified_at, password, remember_token, created_at
            )
            VALUES
                (1, 'Juan Carlos', 'Landero', 'Isidro', '2', 'jc_l23@hotmail.com', null, '" . bcrypt('gtrealmadrid21') . "', null, NOW()),
                (2, 'Ricardo', 'Lopez', 'Roman', '2', 'ricardo@hotmail.com', null, '" . bcrypt('12345678') . "', null, NOW()),
                (3, 'Carlos', 'Landero', 'Isidro', '3', 'jcarlos210193@gmail.com', null, '" . bcrypt('gtrealmadrid21') . "', null, NOW()),
                (4, 'Diana', 'Jimenez', 'Sanchez', '3', 'diana@gmail.com', null, '" . bcrypt('12345678') . "', null, NOW())
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
