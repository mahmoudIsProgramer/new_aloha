<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('color_translations', function (Blueprint $table) {

      $table->increments('id');
      $table->string('title')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();
      $table->integer('color_id')->unsigned();

      $table->string('locale')->index();
      $table->unique(['color_id', 'locale']);
      $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('color_translations');
  }
}
