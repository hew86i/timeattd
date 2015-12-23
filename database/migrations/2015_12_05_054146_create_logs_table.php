<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_id');
            $table->timestamp('datetime');
            $table->integer('verified')->default(0);
            $table->integer('status');
            $table->integer('workcode');

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
        Schema::drop('logs');
    }
}
