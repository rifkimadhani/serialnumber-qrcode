<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientDevicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('client_devices')->insert([
            [
                'client_id' => 1,
                'device_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 1,
                'device_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 2,
                'device_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 3,
                'device_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 3,
                'device_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 4,
                'device_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}