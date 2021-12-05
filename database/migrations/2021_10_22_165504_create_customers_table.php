<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name', 200);
            $table->string('email', 100);
            $table->string('password', 200);
            $table->string('cpf', 50);
            $table->enum('status', ['verificado', 'nao-verificado']);
            $table->enum('genre', ['Masculino', 'Feminino', 'Nao Binario']);
            $table->enum('role', ['usuario', 'administrador']);
            $table->string('number', 80)->nullable();
            $table->text('birth_date');
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
        Schema::dropIfExists('customers');
    }
}
