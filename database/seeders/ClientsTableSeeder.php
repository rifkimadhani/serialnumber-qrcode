<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            [
                'name' => 'Holiday Inn Sanur', // 1
                'project' => 'Hospitality Solution',
                'status' => 'Production',
                'country' => 'Indonesia',
                'address' => 'Sanur, Bali',
                'pic_name' => 'John Doe',
                'pic_contact' => '08123456789',
                'notes' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Acappella Suite Hotel',  // 2
                'project' => 'Hospitality Solution',
                'status' => 'Production',
                'country' => 'Malaysia',
                'address' => 'Shah Alam, Selangor',
                'pic_name' => 'Alex Gaskarth',
                'pic_contact' => '08123456789',
                'notes' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RSIA Bunda Cikini', // 3
                'project' => 'Digital Signage',
                'status' => 'Production',
                'country' => 'Indonesia',
                'address' => 'Cikini, Jakarta Selatan',
                'pic_name' => 'Anna Müller',
                'pic_contact' => '08123456789',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RSU Bunda Margonda', // 4
                'project' => 'Digital Signage',
                'status' => 'Production',
                'country' => 'Indonesia',
                'address' => 'Kota Depok, Jawa Barat 16424',
                'pic_name' => 'Anna Müller',
                'pic_contact' => '08123456789',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'The Mansion Jasmine', // 5
                'project' => 'Hospitality Solution',
                'status' => 'Production',
                'country' => 'Indonesia',
                'address' => 'Kemayoran, Jakarta Utara',
                'pic_name' => 'Lany Setiabudhi',
                'pic_contact' => '08123456789',
                'notes' => 'Important high value client',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}