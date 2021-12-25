<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->bigInteger('payment_id')->unique();
            $table->float('total_order_price');
            $table->text('payment_method');
            $table->text('payment_type');
            $table->string('status', 100);
            $table->string('status_detail', 100);
            $table->integer('logistic_status')->default(1);
            $table->text('ip_address');
            $table->text('external_reference');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
