<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->bigInteger('payment_id');
            $table->foreign('payment_id')
                ->references('payment_id')
                ->on('orders');

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            
            $table->string('title', 100);
            $table->string('text', 600);
            $table->integer('stars')->nullable();
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
        Schema::dropIfExists('assessments');
    }
}
