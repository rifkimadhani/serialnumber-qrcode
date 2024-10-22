<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('client_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('device_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');

            $table->unique(['client_id', 'device_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_devices');
    }
}
