<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connected', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address');
            $table->integer('device_id')->unsigned();
            $table->integer('connected')->default(0);

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
        Schema::drop('connected');
    }
}
