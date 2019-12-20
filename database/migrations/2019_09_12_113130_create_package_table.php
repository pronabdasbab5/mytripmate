<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('packageCategory')->comment('1 = Domestic, 2 = International');
            $table->string('packageId', 191)->unique();
            $table->integer('packageType');
            $table->string('packageTitle', 191);
            $table->text('packageDesc');
            $table->integer('offer');
            $table->date('journeyDate')->nullable();
            $table->string('duration', 191);
            $table->integer('totalDays');
            $table->integer('totalNights');
            $table->string('location', 191);
            $table->string('longitude', 191);
            $table->string('latitude', 191);
            $table->integer('rating');
            $table->string('coverImage', 191);
            $table->text('includeFacility')->nullable();
            $table->text('excludeFacility')->nullable();
            $table->text('termCondition')->nullable();
            $table->integer('isApplicable')->comment('Package Offer : 1 = Yes, 0 = No');
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
        Schema::dropIfExists('package');
    }
}
