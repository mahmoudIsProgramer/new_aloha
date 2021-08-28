<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteOptionTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('site_option_translations', function (Blueprint $table) {

      $table->increments('id');
      $table->text('address')->nullable();
      $table->text('tit_info')->nullable();
      $table->text('des_info')->nullable();
      $table->text('tit_video')->nullable();
      $table->text('working_time')->nullable();

      $table->string('seo_tit')->nullable();
      $table->text('seo_key')->nullable();
      $table->text('seo_des')->nullable();
      $table->text('seo_google_analatic')->nullable();

      $table->string('copyRights')->nullable();
      $table->string('main_offer_label')->nullable(); // 50% OFF On All Products Shop Our Products Now
      $table->string('pop_offer_title')->nullable();
      $table->string('pop_offer_description')->nullable();

      $table->string('locale')->index();

      $table->integer('site_option_id')->unsigned();
      $table->unique(['site_option_id', 'locale']);
      $table->foreign('site_option_id')->references('id')->on('site_options')->onDelete('cascade');

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
    Schema::dropIfExists('site_option_translations');
  }
}
