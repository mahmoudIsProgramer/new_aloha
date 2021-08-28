<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocodesTable extends Migration
{

  public function up()
  {
    Schema::create('promocodes', function (Blueprint $table) {

      $table->increments('id');
      $table->string('status')->default(1); //0,1
      $table->string('code')->nullable();
      $table->string('title')->nullable();
      $table->text('description')->nullable();
      $table->dateTime('startDateTime')->nullable();
      $table->dataTime('endDateTime')->nullable();
      // $table->time('startTime')->nullable();
      // $table->time('endTime')->nullable();
      $table->integer('limit')->nullable();
      $table->integer('used')->default(0);
      $table->string('type'); // percent or value
      $table->integer('discount_amount')->nullable();

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
    Schema::dropIfExists('promocodes');
  }
}
