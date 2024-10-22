<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id(); // Operation ID
            $table->unsignedBigInteger('client_id'); // Client ID
            $table->enum('type', ['deliver', 'returns']); // Operation type (deliver or returns)
            $table->unsignedBigInteger('device_id'); // Device ID
            $table->integer('device_total'); // Total devices for the operation
            $table->date('date'); // Operation date
            $table->timestamps(); // Timestamps

            // Foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('operations');
    }
}