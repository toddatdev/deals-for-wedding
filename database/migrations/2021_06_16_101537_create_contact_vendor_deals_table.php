<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactVendorDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_vendor_deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->text('message')->nullable();
            $table->string('phone',10)->nullable();
            $table->date('wedding_date')->nullable();
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
        Schema::table('contact_vendor_deals', function (Blueprint $table) {
            //
        });
    }
}
