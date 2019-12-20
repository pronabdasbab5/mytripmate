<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hotelType', 191)->comment('1 = Budget, 2 = Delux');
            $table->string('hotelName', 191);
            $table->text('hotelAddress');
            $table->float('price', 8, 2);
            $table->string('rating', 6)->nullable();
            $table->integer('status')->default(1)->comment('1 = Active, 0 = In-Active');
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
        Schema::dropIfExists('package_hotels');
    }
}
