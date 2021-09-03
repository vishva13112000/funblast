<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shopcategory_id');
            $table->string('name');
            $table->string('ownername');
            $table->string('profile');
            $table->string('email');
            $table->string('password');
            $table->string('phoneno');
            $table->text('address');
            $table->boolean('verify')->default(0);
            $table->string('gst_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('aadhar_copy')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->foreign('shopcategory_id')->on('shop_categories')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')->on('countries')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->on('states')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
