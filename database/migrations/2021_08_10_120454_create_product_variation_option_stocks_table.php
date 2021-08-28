<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationOptionStocksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('product_variation_option_stocks', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('stock')->nullable();

      $table->integer('product_id')->unsigned()->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

      $table->integer('variant_id')->unsigned()->nullable();
      $table->foreign('variant_id')->references('id')->on('variations')->onDelete('cascade');

      $table->integer('option_id')->unsigned()->nullable();
      $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');

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
    Schema::dropIfExists('product_variation_option_stocks');
  }
}
