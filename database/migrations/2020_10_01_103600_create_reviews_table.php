<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up()
  {
    Schema::create('reviews', function (Blueprint $table) {

      $table->increments('id');

      $table->text('comment')->nullable();

      $table->string('status')->nullable()->default('1'); // default In-Active

      $table->double('review')->default(1); // number of starts

      $table->unsignedInteger('product_id');
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

      $table->unsignedInteger('customer_id');
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
    Schema::dropIfExists('reviews');
  }
}
