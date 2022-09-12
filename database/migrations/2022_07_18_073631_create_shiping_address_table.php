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
            $table->string('customer_name');
            $table->string('phone_number');
            $table->string('city');
            $table->string('district');
            $table->string('wards');
            $table->string('address');
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
