<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsubcategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('subsubcategories', function (Blueprint $table) {

      $table->increments('id');
      $table->string('status')->default(1); // active

      $table->string('image')->default('default.png');
      $table->string('big_image')->nullable()->default('default.png');

      $table->string('menu')->default('no'); // show on the menu or not
      $table->string('show_on_home_page')->default('no'); // show on home page

      $table->integer('subcategory_id')->unsigned()->nullable();
      $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

      $table->string('created_by')->nullable();
      $table->string('updated_by')->nullable();

      // $table->integer('created_by_id')->unsigned()->nullable();
      // $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');

      // $table->integer('updated_by_id')->unsigned()->nullable();
      // $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('set null');

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
    Schema::dropIfExists('subsubcategories');
  }
}
