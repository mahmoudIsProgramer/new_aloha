<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_translations', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');

            $table->string('locale')->index();
            $table->integer('tax_id')->unsigned();
            $table->unique(['tax_id', 'locale']);
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_translations');
    }
}
