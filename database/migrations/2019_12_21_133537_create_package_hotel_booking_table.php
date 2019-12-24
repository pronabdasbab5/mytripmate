<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageHotelBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_hotel_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bookingId');
            $table->integer('packageId');
            $table->integer('hotelType')->comment('1 = Budget, 2 = Delux');
            $table->integer('hotelId');
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
        Schema::dropIfExists('package_hotel_booking');
    }
}
