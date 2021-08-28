<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('specifications', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('category_id')->unsigned()->nullable();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

      $table->string('image')->nullable()->default('default.png');

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
    Schema::dropIfExists('specifications');
  }
}
