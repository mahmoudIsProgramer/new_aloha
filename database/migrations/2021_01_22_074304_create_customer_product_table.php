<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerProductTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customer_product', function (Blueprint $table) {
      $table->increments('id');

      $table->double('qty');

      $table->integer('customer_id')->unsigned()->nullable();
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

      $table->integer('product_id')->unsigned()->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

      $table->integer('seller_id')->unsigned()->nullable();
      $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');

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
    Schema::dropIfExists('customer_product');
  }
}
