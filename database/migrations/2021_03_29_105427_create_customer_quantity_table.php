<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerQuantityTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customer_quantity', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('qty')->nullable();
      $table->text('color')->nullable();
      // $table->integer('price')->nullable();
      $table->integer('total')->nullable();

      $table->integer('product_id')->unsigned()->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

      $table->integer('customer_id')->unsigned()->nullable();
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

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
    Schema::dropIfExists('customer_quantity');
  }
}
