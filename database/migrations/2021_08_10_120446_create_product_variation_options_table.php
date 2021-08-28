<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationOptionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('product_variation_options', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('product_id')->unsigned()->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

      $table->integer('variant_id')->unsigned()->nullable();
      $table->foreign('variant_id')->references('id')->on('variations')->onDelete('cascade');

      $table->integer('option_id')->unsigned()->nullable();
      $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');

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
    Schema::dropIfExists('product_variation_options');
  }
}
