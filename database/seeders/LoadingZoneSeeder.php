<?php

namespace Database\Seeders;

use App\Models\LoadingZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoadingZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoadingZone::insert([
            [
                'country_id' => 12,
                'name' => 'Zone 1',
                'time' => '24H',
                'created_at' => now(),
            ],
            [
                'country_id' => 12,
                'name' => 'Zone 2',
                'time' => '24-48H',
                'created_at' => now(),
            ],
            [
                'country_id' => 12,
                'name' => 'Zone 3',
                'time' => '24-48H',
                'created_at' => now(),
            ],
            [
                'country_id' => 12,
                'name' => 'Zone 4',
                'time' => '48-72H',
                'created_at' => now(),
            ],
            [
                'country_id' => 12,
                'name' => 'Zone 5',
                'time' => '48-72H',
                'created_at' => now(),
            ],
            [
                'country_id' => 12,
                'name' => 'Zone 6',
                'time' => '48-72H',
                'created_at' => now(),
            ],
            [
                'country_id' => 12,
                'name' => 'Zone 7',
                'time' => '48-72H',
                'created_at' => now(),
            ]
        ]);
    }
}
