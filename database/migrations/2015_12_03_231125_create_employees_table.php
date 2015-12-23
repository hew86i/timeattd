<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pin');
            $table->string('name');
            $table->integer('device_id')->unsigned();
            $table->string('password')->default(1111);
            $table->integer('group')->default(1);
            $table->integer('privilege')->default(0);  //privilege (0: regular user, 2: enroller, 6: admin and 14: superadmin)
            $table->string('card')->default(0); // no card
            $table->string('pin2')->default(0);
            $table->string('tz1')->default(0);
            $table->string('tz2')->default(0);
            $table->string('tz3')->default(0);
            // custom fields here:
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
        Schema::drop('employees');
    }
}
