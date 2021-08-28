<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sim_translations', function (Blueprint $table) {

      $table->increments('id');
      $table->string('title')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();
      $table->integer('sim_id')->unsigned();

      $table->string('locale')->index();
      $table->unique(['sim_id', 'locale']);
      $table->foreign('sim_id')->references('id')->on('sims')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('sim_translations');
  }
}
