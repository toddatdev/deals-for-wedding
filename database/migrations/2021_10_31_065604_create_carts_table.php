<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->bigInteger('category_id');
            $table->bigInteger('state_id');
            $table->text('description');
            $table->text('teaser_text');
            $table->string('image');
            $table->decimal('price');
            $table->decimal('offer_price');
            $table->decimal('checkout_price');
            $table->string('discountcode');
            $table->date('expiration_date');
            $table->string('multiple_cities');
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
        Schema::dropIfExists('carts');
    }
}
