<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Hotel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Apartment',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hospital',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Foundation',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Company',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
