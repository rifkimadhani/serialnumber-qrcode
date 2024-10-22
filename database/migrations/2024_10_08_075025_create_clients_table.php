<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Client ID
            $table->string('name'); // Client name
            $table->string('project');
            $table->string('status'); // Status (POC/Production)
            $table->string('country'); // Country
            $table->string('address'); // Address
            $table->string('pic_name'); // Person in charge name
            $table->string('pic_contact'); // Person in charge contact
            $table->longText('notes')->nullable(); // Notes
            $table->timestamps(); // Timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
