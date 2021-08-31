<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubordersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('suborders', function (Blueprint $table) {
      $table->increments('id');

      $table->double('commision')->nullable();
      $table->integer('total')->nullable();
      $table->string('status')->default('pendding'); // waitPayment ,  pendding,inShipment,onDelivery,completed,canceled , returned

      $table->integer('seller_id')->unsigned()->nullable();
      $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('set null');

      $table->integer('order_id')->unsigned()->nullable();
      $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

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
    Schema::dropIfExists('suborders');
  }
}
