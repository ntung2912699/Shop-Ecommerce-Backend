<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipingAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiping_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_profile_id');
            $table->string('country');
            $table->string('city');
            $table->string('district');
            $table->string('wards');
            $table->string('street');
            $table->string('apartment_number');
            $table->string('zip_code');
            $table->string('status');
            $table->timestamps();

            $table->foreign('users_profile_id')
                ->references('id')
                ->on('users_profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shiping_address');
    }
}
