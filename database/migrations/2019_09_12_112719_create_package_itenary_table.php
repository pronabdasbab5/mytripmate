<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageItenaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_itenary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('packageId');
            $table->integer('days');
            $table->string('title', 191);
            $table->string('location', 191);
            $table->text('desc');
            $table->string('image', 191);
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
        Schema::dropIfExists('package_itenary');
    }
}
