<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {

      $table->increments('id');

      $table->integer('subtotal')->nullable();
      $table->double('commision')->nullable();
      $table->integer('total')->nullable();
      $table->string('device_type')->nullable(); // web , android , ios
      $table->string('status')->default('pendding'); // waitPayment ,  pendding,inShipment,onDelivery,completed,canceled , returned

      $table->integer('shipping_id')->nullable(); // Shipping number
      $table->string('order_notes')->nullable();

      $table->string('payment_method')->default(0); // cacheOnDelivery or payOnline,
      $table->string('payment_status')->default(0); // done paied =1 or not = 0

      $table->double('taxes')->default(0.0);
      $table->double('delivery_fees')->default(0.0);

      $table->string('promocode')->nullable();
      $table->integer('promocode_value')->nullable();

      $table->integer('customer_id')->unsigned()->nullable();
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

      $table->integer('address_id')->unsigned()->nullable();
      $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

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
    Schema::dropIfExists('orders');
  }
}
