<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPageTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('static_page_translations', function (Blueprint $table) {

            $table->increments('id');

            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('locale')->index();

            $table->integer('static_page_id')->unsigned();
            $table->unique(['static_page_id', 'locale']);
            $table->foreign('static_page_id')->references('id')->on('static_pages')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('static_page_translations');
    }
}
