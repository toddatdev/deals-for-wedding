<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('city',255)->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->text('description')->nullable();
            $table->string('image',255)->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->decimal('offer_price', 10,2)->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('status')->default(1)->nullable();
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
        Schema::table('deals', function (Blueprint $table) {
            //
        });
    }
}
