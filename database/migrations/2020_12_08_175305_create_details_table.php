<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('details', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('specification_id')->unsigned()->nullable();
      $table->foreign('specification_id')->references('id')->on('specifications')->onDelete('cascade');

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
    Schema::dropIfExists('details');
  }
}
