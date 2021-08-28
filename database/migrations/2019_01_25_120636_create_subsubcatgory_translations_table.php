<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsubcatgoryTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('subsubcategory_translations', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->integer('subsubcategory_id')->unsigned();

      $table->string('locale')->index();
      $table->unique(['subsubcategory_id', 'locale']);
      $table->foreign('subsubcategory_id')->references('id')->on('subsubcategories')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('subsubcategory_translations');
  }
}
