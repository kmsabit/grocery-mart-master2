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
            $table->id();
            $table->bigInteger('order_id');
            $table->string('date', '100');
            $table->string('first_name', '50');
            $table->string('last_name', '50');
            $table->string('street_address_one', '255');
            $table->string('street_address_two', '255');
            $table->string('town', '100');
            $table->string('zip', '50');
            $table->string('phone', '20');
            $table->string('email', '100');
            $table->string('product_name', '255');
            $table->string('product_image', '255');
            $table->bigInteger('product_price');
            $table->bigInteger('product_quantity');
            $table->bigInteger('cart_sub');
            $table->string('cart_total', '50');
            $table->string('payment', '100');
            $table->string('status', '100');
            $table->bigInteger('client_id');
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
        Schema::dropIfExists('orders');
    }
}
