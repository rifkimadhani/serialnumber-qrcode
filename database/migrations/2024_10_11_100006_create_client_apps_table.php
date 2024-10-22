<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAppsTable extends Migration
{
    public function up()
    {
        Schema::create('client_apps', function (Blueprint $table) {
            $table->id(); // ID
            $table->unsignedBigInteger('client_id'); // Client ID
            $table->unsignedBigInteger('app_id'); // App ID
            $table->timestamps(); // Timestamps

            // Foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_apps');
    }
}