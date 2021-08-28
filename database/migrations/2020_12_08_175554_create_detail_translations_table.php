<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('detail_translations', function (Blueprint $table) {

      $table->increments('id');
      $table->string('name')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();

      $table->string('locale')->index();
      $table->integer('detail_id')->unsigned();
      $table->unique(['detail_id', 'locale']);
      $table->foreign('detail_id')->references('id')->on('details')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('detail_translations');
  }
}
