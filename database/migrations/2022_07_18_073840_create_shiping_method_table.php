<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipingMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiping_method', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transporters_id');
            $table->string('name')->unique();
            $table->decimal('postage');
            $table->timestamps();

            $table->foreign('transporters_id')
                ->references('id')
                ->on('transporters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shiping_method');
    }
}
