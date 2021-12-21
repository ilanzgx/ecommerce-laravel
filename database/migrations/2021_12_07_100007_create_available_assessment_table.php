<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableAssessmentTable extends Migration
{
    public function up()
    {
        Schema::create('available_assessment', function (Blueprint $table) {
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

            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('available_assessment');
    }
}
