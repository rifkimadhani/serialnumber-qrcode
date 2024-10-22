<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('apps')->insert([
            [
                'name' => 'HolidayInn_CMS', #1
                'version' => '1.10',
                'type' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'HolidayInn_STB', #2
                'version' => '1.20',
                'type' => 'android',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Acappella_CMS', #3
                'version' => '1.6',
                'type' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Acappella_STB', #4
                'version' => '1.5',
                'type' => 'android',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RSBunda_CMS', #5
                'version' => '1.2',
                'type' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RSBunda_STB', #6
                'version' => '1.2',
                'type' => 'android',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TheMansion_CMS', #7
                'version' => '1.4',
                'type' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TheMansion_STB', #8
                'version' => '1.2',
                'type' => 'android',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}