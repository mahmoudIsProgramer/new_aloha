<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('type_translations', function (Blueprint $table) {

      $table->increments('id');
      $table->string('title')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();
      $table->integer('type_id')->unsigned();

      $table->string('locale')->index();
      $table->unique(['type_id', 'locale']);
      $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('type_translations');
  }
}
