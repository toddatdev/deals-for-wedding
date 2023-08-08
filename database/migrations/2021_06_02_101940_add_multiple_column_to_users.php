<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', '11')->default('2')->comment="1=admin, 2=user";
            $table->year('dob')->nullable();
            $table->string('gender', 50)->nullable();
            $table->string('image',255)->nullable();
            $table->enum('status', ['1', '0'])->default('1')->comment='1=active, 0=inactive';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role',  'dob', 'gender', 'image', 'status']);
        });
    }
}
