<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lastlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('datetime');

            $table->integer('log_id')->undigned();
            $table->foreign('log_id')->references('id')->on('logs');

            $table->integer('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('devices');

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
        Schema::drop('lastlogs');
    }
}
