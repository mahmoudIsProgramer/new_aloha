<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('products', function (Blueprint $table) {

      $table->increments('id');

      $table->string('status')->nullable()->default('0');
      $table->string('featured')->nullable()->default('0');
      $table->text('grouped_products')->nullable(); // 1,2,3,4,5,6

      $table->string('on_sale')->nullable()->default('0'); // new product

      $table->string('hot_deal')->nullable()->default('0');

      $table->string('product_code')->nullable();
      $table->string('porduct_sku_code')->nullable();

      $table->double('review')->nullable()->default(0); // total rate
      $table->integer('total_number_review')->nullable()->default(0); // total_number_review

      $table->double('selling_price', 8, 2)->nullable()->default(0);
      $table->integer('discount')->nullable()->default(0);

      $table->string('image')->nullable()->default('default.png');


      $table->integer('category_id')->unsigned()->nullable();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

      $table->integer('subcategory_id')->unsigned()->nullable();
      $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');

      $table->integer('subsubcategory_id')->unsigned()->nullable();
      $table->foreign('subsubcategory_id')->references('id')->on('subsubcategories')->onDelete('set null');

      $table->integer('brand_id')->unsigned()->nullable();
      $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');

      $table->integer('size_id')->unsigned()->nullable();
      $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');

      $table->integer('color_id')->unsigned()->nullable();
      $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');

      $table->integer('ram_id')->unsigned()->nullable();
      $table->foreign('ram_id')->references('id')->on('rams')->onDelete('set null');

      $table->integer('sim_id')->unsigned()->nullable();
      $table->foreign('sim_id')->references('id')->on('sims')->onDelete('set null');

      $table->integer('capacity_id')->unsigned()->nullable();
      $table->foreign('capacity_id')->references('id')->on('capacities')->onDelete('set null');

      $table->integer('material_id')->unsigned()->nullable();
      $table->foreign('material_id')->references('id')->on('materials')->onDelete('set null');

      $table->integer('type_id')->unsigned()->nullable();
      $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');

      $table->string('created_by')->nullable();
      $table->string('updated_by')->nullable();

      $table->softDeletes();  // add this line

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
    Schema::dropIfExists('products');
  }
}
