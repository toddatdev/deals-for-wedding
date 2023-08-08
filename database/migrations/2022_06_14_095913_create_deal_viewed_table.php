<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealViewedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_viewed', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('deal_id')->nullable();

            $table->string('user_name',)->nullable();
            $table->string('user_phone',10)->nullable();
            $table->string('user_email')->nullable();
            $table->string('wedding_date')->nullable();
            $table->string('deal_name')->nullable();
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_viewed');
    }
}
