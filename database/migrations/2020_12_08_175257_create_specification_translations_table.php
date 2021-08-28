<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('specification_translations', function (Blueprint $table) {

      $table->increments('id');
      $table->string('name')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();

      $table->string('locale')->index();
      $table->integer('specification_id')->unsigned();
      $table->unique(['specification_id', 'locale']);
      $table->foreign('specification_id')->references('id')->on('specifications')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('specification_translations');
  }
}
