<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up()
  {
    Schema::create('complaints', function (Blueprint $table) {

      $table->increments('id');

      $table->text('name')->nullable();
      $table->text('phone')->nullable();

      $table->string('image')->nullable();
      $table->string('complaint')->nullable();
      $table->integer('state')->default(0);

      $table->integer('customer_id')->unsigned()->nullable();
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

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
    Schema::dropIfExists('complaints');
  }
}
