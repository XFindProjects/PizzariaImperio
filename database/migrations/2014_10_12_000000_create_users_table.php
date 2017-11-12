<?php

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('role')->default(1);
            /*
             * 1 - Garcons
             * 2 - Cozinha de pizzas
             * 3 - Cozinha de porções
             * 4 - Cozinha de sucos
             * 5 - Admin
             *
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
