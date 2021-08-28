<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('name')->nullable();

            $table->integer('percent')->nullable(); // discount percent
            $table->integer('status')->default('1')->nullable(); // discount percent

            // select at leaet one from[category_id,subcategory_id,brand_id]
            $table->integer('category_id')->unsigned()->nullable(); //nullable
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('subcategory_id')->unsigned()->nullable(); //nullable
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->integer('brand_id')->unsigned()->nullable(); //nullable
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

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
        Schema::dropIfExists('offers');
    }
}
