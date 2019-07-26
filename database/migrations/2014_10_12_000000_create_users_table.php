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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('nivel_user');
            $table->timestamp('email_verified_at')->nullable();
            // nullable(quando o usuário faz com facebook e nao precisa de senha)
            $table->string('password')->nullable();
            // o facebook não vai enviar uma imagem e sim uma url, por isso é uma img em string
            // 292 é o tamanho padrão, sempre que passarmos uma string sem passar o valor ele vai por default
            $table->string('img', 292)->nullable();
            // aqui vai ser incluido qual rede social o usuário se logou
            $table->string('provider')->nullable();
            $table->bigInteger('provider_id')->nullable();
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
