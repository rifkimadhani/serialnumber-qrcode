<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdToQrCodesTable extends Migration
{
    public function up()
    {
        Schema::table('qr_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable()->after('id');
            $table->unsignedBigInteger('device_id')->nullable()->after('client_id');

            // Foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('qr_codes', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['device_id']);
            $table->dropColumn(['client_id', 'device_id']);
        });
    }
}
