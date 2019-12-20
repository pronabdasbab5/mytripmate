<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageHotelRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_hotel_relation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('packageId');
            $table->integer('hotelId');
            $table->integer('status')->default(1)->comment('1 = Active, 2 = De-Active');
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
        Schema::dropIfExists('package_hotel_relation');
    }
}
