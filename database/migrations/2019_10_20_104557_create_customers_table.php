<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{

  public function up()
  {

    Schema::create('customers', function (Blueprint $table) {

      $table->increments('id');
      $table->string('full_name')->nullable();
      $table->string('email')->nullable();
      $table->string('phone')->nullable();
      $table->string('gender')->nullable();
      $table->string('image')->default('default.png');

      $table->string('company_name')->nullable();
      $table->text('address')->nullable();


      $table->double('wallet')->nullable()->default(0);
      // $table->double('debits')->nullable()->default(0);
      $table->string('promocode')->nullable();

      $table->text('firebaseToken')->nullable();
      $table->string('social_id')->nullable();

      $table->string('status')->default('1'); // Active
      $table->string('verified')->default(0);

      $table->text('verification_token')->nullable();
      $table->timestamp('email_verified_at')->nullable();

      $table->string('password')->nullable();
      $table->text('notes')->nullable();
      // used for  social login
      $table->string('provider')->nullable();
      $table->string('provider_id')->nullable();

      $table->double('lat')->nullable();
      $table->double('lng')->nullable();

      $table->integer('city_id')->unsigned()->nullable();
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');

      $table->integer('state_id')->unsigned()->nullable();
      $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');

      $table->rememberToken();
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
    Schema::dropIfExists('customers');
  }
}
