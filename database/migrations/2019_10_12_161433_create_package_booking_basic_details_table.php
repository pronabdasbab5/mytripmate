<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageBookingBasicDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_booking_basic_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId');
            $table->string('txtNo', 191);
            $table->string('startDate', 30);
            $table->integer('packageId');
            $table->integer('hotelId');
            $table->integer('totalPersons');
            $table->string('payableAmount');
            $table->string('paid_amount', 191)->nullable();
            $table->string('remaining_amount', 191)->nullable();
            $table->integer('couponId')->nullable();
            $table->string('payment_id', 191)->nullable();
            $table->string('payment_request_id', 191)->nullable();
            $table->integer('paymentType')->comment('1 = Full Amount, 0 = Partial Amount');
            $table->integer('status')->comment('1 = New Booking, 2 = Confirm Booking, 3 = Cancel Booking, 4 = Complete Booking, 5 = All Booking');
            $table->integer('paymentStatus')->comment('1 = Paid, 0 = Pending');
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
        Schema::dropIfExists('package_booking_basic_details');
    }
}
