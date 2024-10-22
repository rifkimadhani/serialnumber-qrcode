<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('client_categories', function (Blueprint $table) {
            $table->id(); // ID
            $table->unsignedBigInteger('client_id'); // Client ID
            $table->unsignedBigInteger('category_id'); // Device ID
            $table->timestamps(); // Timestamps

            // Foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_categories');
    }
}