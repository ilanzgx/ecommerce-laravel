<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('email', 100);
            $table->string('senha', 200);
            $table->string('cpf', 50);
            $table->enum('status', ['verificado', 'nao-verificado']);
            $table->enum('genero', ['masculino', 'feminino', 'nao-binario']);
            $table->enum('perfil', ['administrador', 'usuario']);
            $table->integer('telefone')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
