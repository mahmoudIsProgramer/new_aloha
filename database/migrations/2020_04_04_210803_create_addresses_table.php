<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('addresses', function (Blueprint $table) {
      $table->increments('id');

      $table->string('full_name')->nullable();
      $table->string('street_name')->nullable();
      $table->string('building_number')->nullable();
      $table->string('floor_number')->nullable();
      $table->string('apartment_number')->nullable();
      $table->string('landmark')->nullable();
      $table->string('location_type')->nullable();
      $table->string('phone')->nullable();
      $table->string('address')->nullable();
      $table->string('zone')->nullable();

      $table->integer('customer_id')->unsigned()->nullable();
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

      $table->integer('city_id')->unsigned()->nullable();
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

      $table->integer('state_id')->unsigned()->nullable();
      $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

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
    Schema::dropIfExists('addresses');
  }
}
