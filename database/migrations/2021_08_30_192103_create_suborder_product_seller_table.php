<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuborderProductSellerTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('suborder_product_seller', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('qty')->nullable();
      $table->integer('price')->nullable();
      $table->integer('price_before_discount')->nullable();
      $table->integer('total')->nullable();  // price * qty
      $table->string('status')->default('solid'); // solid,  returned

      $table->double('commision')->nullable(); // per product

      $table->integer('product_seller_id')->unsigned()->nullable(); // by this id will get seller  , and product info
      $table->foreign('product_seller_id')->references('id')->on('product_seller')->onDelete('cascade');

      $table->integer('suborder_id')->unsigned()->nullable();
      $table->foreign('suborder_id')->references('id')->on('suborders')->onDelete('cascade');

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
    Schema::dropIfExists('suborder_product_seller');
  }
}
