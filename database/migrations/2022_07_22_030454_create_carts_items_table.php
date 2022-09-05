<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carts_id');
            $table->unsignedBigInteger('products_id');
            $table->decimal('price');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('carts_id')
                ->references('id')
                ->on('carts');
            $table->foreign('products_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts_items');
    }
}
