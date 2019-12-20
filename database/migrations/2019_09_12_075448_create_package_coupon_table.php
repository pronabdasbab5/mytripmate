<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_coupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('couponNumber', 30);
            $table->integer('flatAmount');
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
        Schema::dropIfExists('package_coupon');
    }
}
