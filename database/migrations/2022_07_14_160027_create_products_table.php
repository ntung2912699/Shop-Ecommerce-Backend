<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('categories_id')
                ->unsigned();
            $table->string('name');
            $table->string('thumbnail');
            $table->text('gallery');
            $table->decimal('price', 13, 0);
            $table->integer('quantity');
            $table->longText('short_description');
            $table->string('status');
            $table->timestamps();

            $table->foreign('categories_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
