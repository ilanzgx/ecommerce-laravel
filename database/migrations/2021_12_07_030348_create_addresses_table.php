<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->text('cep');
            $table->text('identification');
            $table->text('logradouro');
            $table->integer('number');
            $table->text('complement');
            $table->text('reference_point');
            $table->text('district');
            $table->text('city');
            $table->text('uf');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
