<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSellerTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('product_seller', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('stock')->nullable()->default(0);
      $table->string('status')->nullable()->default(0); // accept or reject this seller to sell this product

      $table->double('count_solid')->nullable();
      $table->double('selling_price')->nullable();
      $table->double('discount')->nullable();
      $table->string('sku')->nullable();
      $table->text('seller_notes')->nullable();

      $table->integer('seller_id')->unsigned()->nullable();
      $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');

      $table->integer('product_id')->unsigned()->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

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
    Schema::dropIfExists('product_seller');
  }
}
