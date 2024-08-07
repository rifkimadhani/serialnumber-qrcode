<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                DB::table('users')->insert([
            [
                'name' => 'Madeira Entertainz',
                'username' => 'madeira',
                'email' => 'rifkimadhani@madeiraresearch.com',
                'password' => Hash::make('$qrCodes'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}