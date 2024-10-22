<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('client_categories')->insert([
            [
                'client_id' => 1,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 2,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 3,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 4,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'client_id' => 5,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
