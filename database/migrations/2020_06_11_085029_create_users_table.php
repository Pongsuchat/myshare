<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userName')->unique();
            $table->string('phoneNumber')->unique();
            $table->string('countryCode');
            $table->string('password');
            $table->string('personalPicture');
            $table->string('userToken');
            $table->string('role');
            $table->string('deviceToken');
            $table->decimal('rating');
            $table->object('altAddress');
            $table->object('currentAddress');
            $table-timstamp('created');
            $table->string('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
