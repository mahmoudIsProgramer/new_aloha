<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up()
  {
    Schema::create('order_product', function (Blueprint $table) {

      $table->increments('id');

      $table->integer('qty')->nullable();
      $table->text('color')->nullable();
      $table->integer('total')->nullable();
      $table->integer('price')->nullable();
      $table->integer('price_before_discount')->nullable();
      $table->double('promocode_discount')->nullable(); // per product
      $table->double('taxes')->nullable(); // per product
      $table->string('status')->default('solid'); // solid,  returned

      // $table->integer('owner_percent')->nullable();

      $table->integer('product_id')->unsigned()->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

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
    Schema::dropIfExists('order_product');
  }
}
