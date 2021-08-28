<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariationTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('variation_translations', function (Blueprint $table) {

      $table->increments('id');

      $table->text('title')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();

      $table->string('locale')->index();
      $table->integer('variation_id')->unsigned();
      $table->unique(['variation_id', 'locale']);
      $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('variation_translations');
  }
}
