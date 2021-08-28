<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapacityTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('capacity_translations', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();
      $table->integer('capacity_id')->unsigned();

      $table->string('locale')->index();
      $table->unique(['capacity_id', 'locale']);
      $table->foreign('capacity_id')->references('id')->on('capacities')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('capacity_translations');
  }
}
