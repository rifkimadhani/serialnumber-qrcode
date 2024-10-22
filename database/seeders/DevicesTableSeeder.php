<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('devices')->insert([
            [
                'name' => 'Quokka Box',
                'model' => 'QOBFHD-TX21624',
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quokka Box',
                'model' => 'QOBFHD-XM21622',
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quokka TV',
                'model' => 'QTV32HD-KC10824',
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quokka Server',
                'model' => 'QSV-NUi781T24',
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Briskmedia Server',
                'model' => 'BSV-NUi781T24',
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}