<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('operations')->insert([
            [
                'client_id' => 1, // Assuming Client A
                'type' => 'deliver',
                'device_id' => 1, // Assuming Device X
                'device_total' => 10,
                'date' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 2, // Assuming Client B
                'type' => 'returns',
                'device_id' => 2, // Assuming Device Y
                'device_total' => 5,
                'date' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 3, // Assuming Client C
                'type' => 'deliver',
                'device_id' => 3, // Assuming Device Z
                'device_total' => 20,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
