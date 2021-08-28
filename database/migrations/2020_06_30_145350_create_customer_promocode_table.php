<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPromocodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_promocode', function (Blueprint $table) {

            $table->increments('id');

            // $table->integer('number_used')->nullable(); // number_used by same customer
            $table->string('promocode')->nullable();

            $table->integer('customer_id')->unsigned()->nullable(); // customer who used the promocode
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            // $table->unique(['customer_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_promocodes');
    }
}
