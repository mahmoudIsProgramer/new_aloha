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
      $table->integer('total')->nullable();
      $table->string('device_type')->nullable(); // web , android , ios
      $table->string('order_type')->default('general'); // general(default), special_qunatity, request_price
      $table->string('status')->default('pendding'); // waitPayment ,  pendding,inShipment,onDelivery,completed,canceled , returned

      $table->string('shipping_number')->nullable(); // Shipping number
      $table->string('customer_name')->nullable();
      $table->string('company_name')->nullable();
      $table->string('customer_address')->nullable();
      $table->string('customer_phone')->nullable();
      $table->string('customer_email')->nullable();
      $table->string('customer_country')->nullable();
      $table->string('customer_city')->nullable();
      $table->string('order_notes')->nullable();
      $table->text('customer_region')->nullable();
      $table->text('customer_street')->nullable();
      $table->text('customer_home_number')->nullable();
      $table->text('customer_floor_number')->nullable();
      $table->text('customer_flat_number')->nullable();
      $table->text('customer_appartment_number')->nullable();
      $table->string('customer_postal_code')->nullable();
      $table->text('customer_comments_extra')->nullable();
      $table->double('langtude', 8, 2)->default(0.0);
      $table->double('lattude', 8, 2)->default(0.0);

      $table->double('merchanttransactionId')->nullable();

      // $table->string('session_id')->default(0); // payment session

      $table->string('payment_method')->default(0); // cacheOnDelivery or payOnline, wallet, bank_transfer
      $table->string('payment_status')->default(0); // done paied =1 or not = 0

      // $table->integer('compo_discount')->default(0.0);
      // $table->double('order_fees')->default(0.0);
      // $table->double('order_taxs_percentage')->default(0.0);
      $table->double('taxes')->default(0.0);
      $table->double('delivery_fees')->default(0.0);
      // $table->string('delivery_type')->default(0.0); // fast or slow
      // $table->string('home_or_branch')->default(0.0); // home or branch
      // $table->string('branch')->default(0.0); // 'Eltagamo3' or 'Giza'

      // $table->string('gift_value')->nullable();

      $table->string('promocode')->nullable();
      $table->integer('promocode_value')->nullable();

      $table->integer('customer_id')->unsigned()->nullable();
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

      $table->integer('city_id')->unsigned()->nullable();
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

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
