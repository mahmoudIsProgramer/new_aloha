<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('option_translations', function (Blueprint $table) {
      $table->increments('id');

      $table->text('title')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();

      $table->string('locale')->index();
      $table->integer('option_id')->unsigned();
      $table->unique(['option_id', 'locale']);
      $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('option_translations');
  }
}
