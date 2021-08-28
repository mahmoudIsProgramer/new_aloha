<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function (Blueprint $table) {

      $table->increments('id');
      $table->string('status')->default(1); // active
      $table->integer('parent_id')->default(0)->nullable();
      $table->string('menu')->default(1); // show on the menu or not
      $table->string('show_on_home_page')->default(1); // show on home page
      $table->string('featured')->default(1);
      $table->string('comision')->nullable();

      $table->string('image')->default('default.png');

      $table->string('created_by')->nullable();
      $table->string('updated_by')->nullable();

      $table->timestamps();
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('categories');
  }
}
