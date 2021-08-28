<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up()
  {
    Schema::create('deliveries', function (Blueprint $table) {

      $table->increments('id');

      $table->string('status')->nullable()->default('0');

      $table->integer('price')->nullable();
      // $table->integer('slow_price')->nullable();
      // $table->integer('fast_price')->nullable();

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
    Schema::dropIfExists('deliveries');
  }
}
