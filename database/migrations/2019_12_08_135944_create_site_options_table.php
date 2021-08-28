<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteOptionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('site_options', function (Blueprint $table) {

      $table->increments('id');
      $table->double('comision')->default(10);
      $table->string('num1')->nullable();
      $table->string('num2')->nullable();
      $table->string('num3')->nullable();
      $table->string('logo')->default('default.png');
      $table->string('icon')->default('default.png');
      $table->string('email')->nullable();
      $table->string('currency')->nullable()->default('LE');

      # promocodes
      $table->integer('minimum_order_to_apply_promocode')->nullable(); // Code is applied when the order reaches a certain price
      $table->string('minimum_order_option')->default(0); // true or false

      $table->string('send_promocode_after_make_order')->default(0);

      $table->string('free_shipping_option')->default(0); // true or false
      $table->integer('free_shipping_order_amount')->nullable(); // if order excesed specific amount order will be free shipping

      $table->text('link_video')->nullable();
      $table->text('link_ios')->nullable();
      $table->text('link_android')->nullable();

      $table->text('map')->nullable();
      $table->text('fax')->nullable();

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
    Schema::dropIfExists('site_options');
  }
}
