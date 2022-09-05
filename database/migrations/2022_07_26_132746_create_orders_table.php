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
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('shiping_method_id');
            $table->unsignedBigInteger('status_id');
            $table->string('phone_number');
            $table->decimal('grand_total');
            $table->text('note');
            $table->timestamps();

            $table->foreign('users_id')
                ->references('id')
                ->on('users');
            $table->foreign('address_id')
                ->references('id')
                ->on('shiping_address');
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_method');
            $table->foreign('shiping_method_id')
                ->references('id')
                ->on('shiping_method');
            $table->foreign('status_id')
                ->references('id')
                ->on('orders_status');

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
