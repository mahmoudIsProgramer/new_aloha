<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('variations', function (Blueprint $table) {
      $table->increments('id');

      // $table->enum('frontend_type', ['select', 'radio', 'text', 'text_area'])->nullable();
      // $table->boolean('is_filterable')->default(0)->nullable();
      // $table->boolean('is_required')->default(0)->nullable();
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
    Schema::dropIfExists('variations');
  }
}
