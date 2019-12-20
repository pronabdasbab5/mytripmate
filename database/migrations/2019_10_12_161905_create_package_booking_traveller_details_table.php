<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageBookingTravellerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_booking_traveller_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pbbdId');
            $table->string('txtNo', 191);
            $table->string('t_name', 191);
            $table->integer('t_con_no');
            $table->string('t_email', 191);
            $table->string('t_age', 191);
            $table->string('gender', 191);
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
        Schema::dropIfExists('package_booking_traveller_details');
    }
}
