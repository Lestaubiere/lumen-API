<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('name');
            $table->string('address');
            $table->string('zip_code');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('phone_number');

            $table->integer('number_pets');
            $table->string('equipment');
            $table->string('electricity');

            $table->date('date_arrival');
            $table->date('date_departure');

            $table->string('comment');

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
        Schema::dropIfExists('bookings');
    }
}
