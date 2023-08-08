<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('home_page_title',)->nullable();
            $table->text('six_month_subscription_title')->nullable();
            $table->text('one_year_subscription_title')->nullable();
            $table->text('checkout_modal_title')->nullable();
            $table->text('checkout_modal_description')->nullable();
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
        Schema::dropIfExists('dynamic_messages');
    }
}
