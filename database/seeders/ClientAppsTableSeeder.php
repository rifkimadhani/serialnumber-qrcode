<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientAppsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('client_apps')->insert([
            [
                'client_id' => 1, // holidayinn
                'app_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 1, // holidayinn
                'app_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 2, // acappella
                'app_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 2, //acappella
                'app_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 3, //acappella
                'app_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 3, //acappella
                'app_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 5, //acappella
                'app_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 5, //acappella
                'app_id' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
