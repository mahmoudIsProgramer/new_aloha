<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSpecificationTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('product_specification_translations', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->nullable();
      $table->text('short_description')->nullable();
      $table->text('description')->nullable();

      $table->string('locale')->index();
      $table->integer('p_s_id')->unsigned(); // product_specification_id = p_s_id
      $table->unique(['p_s_id', 'locale']);
      $table->foreign('p_s_id')->references('id')->on('product_specification')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('product_specification_translations');
  }
}
