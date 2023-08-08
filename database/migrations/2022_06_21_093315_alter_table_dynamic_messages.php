<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDynamicMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynamic_messages', function (Blueprint $table) {
            $table->text('success_subscription_message')->nullable()->default(null)->after('checkout_modal_description');
            $table->text('success_deal_create_message')->nullable()->default(null)->after('success_subscription_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dynamic_messages', function (Blueprint $table) {
            $table->dropColumn('success_subscription_message');
            $table->dropColumn('success_deal_create_message');
        });
    }
}
