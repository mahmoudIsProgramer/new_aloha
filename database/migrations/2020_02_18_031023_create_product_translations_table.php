<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTranslationsTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('product_translations', function (Blueprint $table) {

      $table->increments('id');
      $table->string('name');
      $table->text('short_description');
      $table->text('description');

      $table->text('seo_key')->nullable();
      $table->text('seo_des')->nullable();
      $table->text('seo_alt')->nullable();

      $table->string('locale')->index();
      $table->integer('product_id')->unsigned();
      $table->unique(['product_id', 'locale']);
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('product_translations');
  }
}
