<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:4:20
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('profile_picture')->nullable();
            $table->string('slug', 100)->unique();
            $table->string('name', 60);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->unsignedInteger('role')->default(1);
            /*
             * 1 - Garcons
             * 2 - Cozinha de pizzas
             * 3 - Cozinha de porções
             * 4 - Cozinha de sucos
             * 5 - Admin
             * See config files to override
             * */
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
