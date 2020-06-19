<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vehicleRegistration')->unique();
            $table->array('vehicleType');
            $table->array('vehiclePicture');
            $table->string('personalCardPicture')->unique();
            $table->string('driveLicensePicture')->unique();
            $table->string('actPicture')->unique();;
            $table->string('registrationPicture')->unique();
            $table->string('insurancePicture')->unique();
            $table->array('vehicleDetailPicture');
            $table->decimal('seat');
            $table->string('personalNo');
            $table->string('insurance');
            $table->string('actNo');
            $table->string('user_id');
            $table->decimal('weight');
            $table->string('status');
            $table->timestamps('approveDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
    }
}
